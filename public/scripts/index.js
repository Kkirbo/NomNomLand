const carousel = document.querySelector('.carousel');
const cards = [...carousel.children];

const cardWidth = cards[0].clientWidth * 0.9;
const gap = parseFloat(getComputedStyle(carousel).gap) || 0;
const step = cardWidth + gap;

/*if (carousel.scrollLeft <= cardWidth * 0.75) {
    carousel.scrollLeft += 10;
}
if (carousel.scrollLeft >= cardWidth * cards.length) {
    carousel.scrollLeft -= cardWidth * cards.length;
}*/
let mouseScrolling = false;
let stopScroll;
carousel.addEventListener('scroll', () => {
    //console.log(`Scroll: ${carousel.scrollLeft} min: ${cardWidth} max: ${cardWidth * (cards.length - 1)}`);
    if (carousel.scrollLeft <= cardWidth && !mouseScrolling) {
        //carousel.scrollLeft = cardWidth;
        carousel.scrollBy({ left: 10, behavior: 'smooth' });
    }
    if (carousel.scrollLeft >= cardWidth * (cards.length - 1) && !mouseScrolling) {
        //carousel.scrollLeft = cardWidth * (cards.length - 1);
        carousel.scrollBy({ left: -10, behavior: 'smooth' });
    }
});