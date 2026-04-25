const searchForm = document.querySelector('form.searchbar');
const searchinput = searchForm.querySelector('div input[type="text"]');
const filtersButton = searchForm.querySelector('button.tune');

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
 * Searchbar Filters
 */
const dropdown = document.querySelector("div.dropdown#filters");
filtersButton.addEventListener("click", (e) => {
  dropdown.classList.toggle("active");
})