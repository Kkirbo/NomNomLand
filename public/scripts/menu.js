import { animateMenuCards } from "./menu-card.js";

const searchResults = document.querySelector("section.search-results");

const observer = new MutationObserver((mutationsList) => {
    for (let mutation of mutationsList) if (mutation.type == "childList") animateMenuCards(0.2);
});
observer.observe(searchResults, { attributes: false, childList: true });