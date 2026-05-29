import { getUserId } from "../scripts/get-user-id.js";
import { requestProfileUpdate } from "./request-profile-update.js";
import { checkLength, validateEmail, validatePhone, validateAddress } from "./form.js";

const sidebarCheckbox = document.querySelector('#togglesidebar');

function cancelInput(input) {
    if (!input) return;
    const span = document.createElement("span");
    span.className = "editable-user-text-info";
    span.dataset.id = input.dataset.id;
    span.dataset.name = input.dataset.name;
    span.textContent = input.placeholder;
    input.replaceWith(span);
}

async function submitInput(input) {
    if (!input) return;
    const span = document.createElement("span");
    span.className = "editable-user-text-info";
    span.dataset.id = input.dataset.id;
    span.dataset.name = input.dataset.name;
    span.textContent = input.placeholder;

    let inputValid = checkLength(input.value).success;
    switch (span.dataset.name) {
        case "email":
            inputValid = inputValid && validateEmail(input.value).success;
            break;
        case "phone":
            inputValid = inputValid && validatePhone(input.value).success;
            break;
        case "address":
            inputValid = inputValid && validateAddress(input.value).success;
            break;
        default:
            break;
    }
    if (!inputValid) {
        input.replaceWith(span);
        return;
    }

    let userId = {status: 200, id: input?.dataset?.id};
    if (!userId) userId = await getUserId();
    if (!userId || userId.status != 200 || !userId.id) {
        input.replaceWith(span);
        return;
    }
    userId = userId.id;
    
    const updated = await requestProfileUpdate(userId, span.dataset.name, input.value);
    if (!updated || updated.status != 200) {
        input.replaceWith(span);
        return;
    }

    span.textContent = input.value;
    input.replaceWith(span);
}

document.addEventListener("keydown", (e) => {
    const activeInputs = document.querySelectorAll("input.editing-user-text-info");
    if (e.keyCode == 27) {
        let canceledInput = false;
        for (const activeInput of activeInputs) if (activeInput) {
            cancelInput(activeInput);
            canceledInput = true;
        }
        if (sidebarCheckbox && canceledInput) setTimeout(() => sidebarCheckbox.checked = !sidebarCheckbox.checked, 1);
    }
    if (e.keyCode == 13) for (const activeInput of activeInputs) if (activeInput) submitInput(activeInput);
});

document.addEventListener("click", async (e) => {
    const activeInputs = document.querySelectorAll("input.editing-user-text-info");
    for (const activeInput of activeInputs) if (activeInput && !activeInput.contains(e.target)) submitInput(activeInput);

    const span = e.target.closest("span.editable-user-text-info");
    if (!span) return;

    const input = document.createElement("input");
    input.className = "editing-user-text-info";
    input.type = span.dataset.name == "email" || span.dataset.name == "password" ? span.dataset.name : "text";
    input.value = span.textContent;
    input.placeholder = span.textContent;
    input.dataset.id = span.dataset.id;
    input.dataset.name = span.dataset.name;
    
    input.style.font = getComputedStyle(span).font;

    span.replaceWith(input);
    input.focus();
});