/**
 * Searchbar Animation
 */
const searchbar = document.querySelector('.searchbar');
const searchinput = searchbar.querySelector('input');
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
searchBarEntersView.observe(searchbar);