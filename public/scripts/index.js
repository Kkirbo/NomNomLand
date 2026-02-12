const carousel = document.querySelector('.carousel');
const cards = [...carousel.children];

const cardWidth = cards[0].getBoundingClientRect().width;
const gap = parseFloat(getComputedStyle(carousel).gap) || 0;
const step = cardWidth + gap;

/* ---- Clone cards ---- *//*
cards.forEach(card => {
  carousel.appendChild(card.cloneNode(true));
  carousel.insertBefore(card.cloneNode(true), carousel.firstChild);
});*/

/**
 * Auto Scroll
 */
let mouseHover;
let autoScroll = setInterval(() => {
    if (mouseHover) return;
    if (carousel.scrollLeft >= step * cards.length) {
        carousel.scrollLeft -= step * cards.length;
    }
    carousel.scrollBy({ left: step, behavior: 'smooth' });
}, 2000);

carousel.addEventListener('mouseenter', () => {mouseHover = true;});
carousel.addEventListener('mouseleave', () => {mouseHover = false;});
carousel.addEventListener('touchstart', () => {mouseHover = true;}, { passive: true });
carousel.addEventListener('touchend', () => {mouseHover = false;});