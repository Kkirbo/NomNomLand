import { sendDataAsync } from "./asyncForm.js";

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

/**
 * Block search submit when on menu page
 */
async function updateSearchResults() {
  const response = await sendDataAsync(searchForm);
  searchResults.innerHTML = response;
}
searchForm.addEventListener("submit", async (e) => {
  if (!window.location.pathname.endsWith("/menu.php") || !searchResults) return;
  e.preventDefault();
  updateSearchResults();
});
searchinput.addEventListener("input", updateSearchResults);
for (const label of searchForm.querySelectorAll("section.dropdown label")) {
  label.addEventListener("input", updateSearchResults);
}

/**
 * Searchbar Filters
 */
const dropdown = searchForm.querySelector("section.dropdown");
tuneButton.addEventListener("click", (e) => {
  dropdown.classList.toggle("active");
});