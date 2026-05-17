import { getSearchResult } from "./get-search-results.js";

const searchForm = document.querySelector('form.searchbar');
const searchResults = document.querySelector('section.search-results');
const searchinput = searchForm.querySelector('section input[type="text"]');
const tuneButton = searchForm.querySelector('button.tune');

/**
 * Searchbar Animation
 */
searchinput.placeholder = "";
const placeholderText = "Search for your favorite meal...";
function animatePlaceholder() {
  if (searchinput.placeholder.length == placeholderText.length) return;
  else searchinput.placeholder += placeholderText[searchinput.placeholder.length];
  window.setTimeout(animatePlaceholder, Math.random() * (250 - 50) + 50);
};
const searchBarEntersView = new IntersectionObserver(() => {
  searchinput.placeholder = "";
  animatePlaceholder();
},
{
  threshold: 1
});
searchBarEntersView.observe(searchForm);

const sortFunctions = {
  alphabetical: (items, invert) => {
    return items.sort((a, b) => {
      const valueA = a.querySelector("h3").textContent.trim().toLowerCase();
      const valueB = b.querySelector("h3").textContent.trim().toLowerCase();
      return valueA.localeCompare(valueB) * invert;
    });
  },
  price: (items, invert) => {
    return items.sort((a, b) => {
      const valueA = parseFloat(a.querySelector("button").textContent.replace("€", ""));
      const valueB = parseFloat(b.querySelector("button").textContent.replace("€", ""));
      return (valueA - valueB) * invert;
    });
  },
  type: (items, invert) => {
    return items.sort((a, b) => {
      const valueA = a.querySelector("ul li").textContent.trim().toLowerCase();
      const valueB = b.querySelector("ul li").textContent.trim().toLowerCase();
      return valueA.localeCompare(valueB) * invert;
    });
  }
}

/**
 * Generate the page based on search
 */
async function updateSearchResults() {
  if (!searchResults || !window.location.pathname.endsWith("/menu.php")) return;
  const response = await getSearchResult(searchForm);
  const GET_PARAMS = new URLSearchParams(window.location.search);
  let sort = GET_PARAMS.get("sort") ?? "alphabetical";
  if (sort != "alphabetical" && sort != "price" && sort != "type") sort = "alphabetical";
  const invert = GET_PARAMS.get("invert") ? parseInt(GET_PARAMS.get("invert")) : 1;
  
  let documentSections = new DOMParser().parseFromString(response, "text/html");
  let sections = documentSections.querySelectorAll("section.menus");

  for (const section of sections) {
    let items = Array.from(section.querySelectorAll("article.menu"));

    items = sortFunctions[sort](items, invert);

    for (const item of items) section.appendChild(item);
  }
  
  searchResults.innerHTML = documentSections.body.innerHTML;
}
//Block search submit when on menu page
searchForm.addEventListener("submit", async (e) => {
  if (!searchResults || !window.location.pathname.endsWith("/menu.php")) return;
  e.preventDefault();
  updateSearchResults();
});
//Optional refresh on input
searchinput.addEventListener("input", updateSearchResults);
for (const label of searchForm.querySelectorAll("section.dropdown label")) {
  label.addEventListener("input", updateSearchResults);
}
updateSearchResults();

/**
 * Searchbar Filters
 */
const dropdown = searchForm.querySelector("section.dropdown");
tuneButton.addEventListener("click", (e) => {
  dropdown.classList.toggle("active");
});

/**
 * Searchbar Sorts
 */
const sortButtons = searchForm.querySelectorAll("button:not(.tune)");
for (const sortButton of sortButtons) {
  sortButton.addEventListener("click", (e) => {
    const GET_PARAMS = new URLSearchParams(window.location.search);
    const sortValue = sortButton.textContent.split(" ")[0].trim().toLowerCase();

    const currentSort = GET_PARAMS.get("sort") ?? "alphabetical";
    let invert = parseInt(GET_PARAMS.get("invert")) || 1;

    if (currentSort === sortValue) invert *= -1;
    else invert = 1;

    GET_PARAMS.set("sort", sortValue);
    if (invert == -1) GET_PARAMS.set("invert", invert);
    else GET_PARAMS.delete("invert");
    
    history.pushState(null, "", `${window.location.pathname}?${GET_PARAMS}`);
    
    sortButtons.forEach(otherSort => {
      otherSort.classList.remove("active");
      otherSort.textContent = otherSort.textContent.split(" ")[0] + " ↓";
    });
    sortButton.textContent = sortValue + (invert === 1 ? " ↓" : " ↑");
    sortButton.classList.add("active");

    updateSearchResults();
  });
}