/**
 * Menu cards Animation
 */
export function animateMenuCards(threshold=0.75) {
    const menuCards = document.querySelectorAll("section.menus article.menu");
    const menuCardEntersView = new IntersectionObserver((entries) => {
        for (let i = 0; i < entries.length; i++) {
            const entry = entries[i];
            if (!entry.isIntersecting) continue;
            setTimeout(() => {
                entry.target.classList.remove("hidden");
            }, 100 * i);
            menuCardEntersView.unobserve(entry.target);
        }
    }, { threshold: threshold });
    for (const menuCard of menuCards) menuCardEntersView.observe(menuCard);
}