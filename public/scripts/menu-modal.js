import { getModalInfo } from "./get-modal-info.js";

const sidebarCheckbox = document.querySelector('#togglesidebar');
const backgroundBlur = document.querySelector('.background-blur');

const headerTitle = backgroundBlur.querySelector(".header h2");
const descVersion = backgroundBlur.querySelector(".description p.dish-version");
const description = backgroundBlur.querySelector(".description div.dish-section");
const descFooter = backgroundBlur.querySelector(".description p.dish-footer");
const footerTitle = backgroundBlur.querySelector(".footer h3");
const footerForm = backgroundBlur.querySelector(".footer form");
const selectStarter = footerForm.querySelector("select[name=\"starter\"]");
const selectMaincourse = footerForm.querySelector("select[name=\"main course\"]");
const selectDrink = footerForm.querySelector("select[name=\"drink\"]");
const selectDessert = footerForm.querySelector("select[name=\"dessert\"]");
const addToCartInput = backgroundBlur.querySelector(".footer form input[type=\"hidden\"]");

export async function updateModal() {
    selectStarter.innerHTML = "";
    selectMaincourse.innerHTML = "";
    selectDrink.innerHTML = "";
    selectDessert.innerHTML = "";
    selectStarter.previousElementSibling.classList.add("hidden");
    selectStarter.disabled = true;
    selectMaincourse.previousElementSibling.classList.add("hidden");
    selectMaincourse.disabled = true;
    selectDrink.previousElementSibling.classList.add("hidden");
    selectDrink.disabled = true;
    selectDessert.previousElementSibling.classList.add("hidden");
    selectDessert.disabled = true;
    if (window.location.hash == '') {
        backgroundBlur.classList.remove("active");
        return;
    }
    
    const GET_PARAMS = new URLSearchParams(window.location.search);
    const allergensFiltered = GET_PARAMS.getAll("allergens[]");
    let traceInAny = false;
    
    let [type, id] = window.location.hash.replace("#", "").split("-");
    if (!type || !id) return;
    
    let modalInfo = await getModalInfo(type, id);
    if (!modalInfo) {
        window.location.href = "#";
        return;
    }
    backgroundBlur.classList.add("active");
    headerTitle.textContent = modalInfo.title;
    addToCartInput.value = modalInfo.id;
    backgroundBlur.querySelector('.background').src = modalInfo.image;
    footerTitle.textContent = `Price: $${modalInfo.price}`;
    descFooter.textContent = modalInfo.comment ?? '';
    if (type === 'menu') {
        descVersion.innerHTML = "";
        description.innerHTML = "Customize your menu";
        for (const dishID of modalInfo.contents) {
            const dishInfo = await getModalInfo("dish", dishID);
            const contains = dishInfo.allergens.some((allergen) => allergensFiltered.indexOf(allergen) != -1);
            if (contains) continue;
            const trace = dishInfo.trace.some((allergen) => allergensFiltered.indexOf(allergen) != -1);
            if (trace) traceInAny = true;
            for (const tag of dishInfo.tags) switch (tag) {
                case "starter":
                    selectStarter.previousElementSibling.classList.remove("hidden");
                    selectStarter.disabled = false;
                    selectStarter.innerHTML += `<option value="${dishID}">${trace?'⚠ ':''}${dishInfo.title}</option>`;
                    break;
                case "main course":
                    selectMaincourse.previousElementSibling.classList.remove("hidden");
                    selectMaincourse.disabled = false;
                    selectMaincourse.innerHTML += `<option value="${dishID}">${trace?'⚠ ':''}${dishInfo.title}</option>`;
                    break;
                case "drink":
                    selectDrink.previousElementSibling.classList.remove("hidden");
                    selectDrink.disabled = false;
                    selectDrink.innerHTML += `<option value="${dishID}">${trace?'⚠ ':''}${dishInfo.title}</option>`;
                    break;
                case "dessert":
                    selectDessert.previousElementSibling.classList.remove("hidden");
                    selectDessert.disabled = false;
                    selectDessert.innerHTML += `<option value="${dishID}">${trace?'⚠ ':''}${dishInfo.title}</option>`;
                    break;
                default:
                    break;
            }
        }
        if (traceInAny) descFooter.innerHTML = "⚠ = Contains trace of a selected allergen, check our <a href=\"allergens.php\">allergens</a> page.";
    } else if (type === 'dish') {
        descVersion.innerHTML = `<p>${modalInfo.version}</p>`;
        description.innerHTML = `
            <h3>Definition</h3><ul>${modalInfo.definition.map(line => `<li>${line}</li>`).join('')}</ul>
            <h3>Specifications</h3><ul>${modalInfo.specifications.map(line => `<li>${line}</li>`).join('')}</ul>
        `;
    }
}

export function closeModal() {
    window.location.href = "#";
}

//Hide modal when clicking outside
backgroundBlur.addEventListener('click', (e) => {
    if (backgroundBlur.children[0].contains(e.target)) return;
    closeModal();
});

//Escape key to close modal
document.addEventListener('keydown', (e) => {
  if (e.keyCode === 27) {
    if (sidebarCheckbox && window.location.hash != "") setTimeout(() => sidebarCheckbox.checked = !sidebarCheckbox.checked, 1);
    closeModal();
  }
});

//openModal when clicking on links
window.addEventListener('hashchange', (e) => {
    updateModal();
});
//Initial update
updateModal();