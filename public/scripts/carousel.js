/**
 * Carousel
 *
 * This module manages a horizontally scrolling card carousel with
 * center snapping, simple infinite-scroll behavior, keyboard navigation,
 * and per-card animation based on proximity to the carousel center.
 */
const carousel = document.querySelector('section.carousel');
let cards = [...carousel.children];
// The first and last actual content cards are bounded by sentinel blank cards.
const firstValidCard = 1;
const lastValidCard = cards.length - 2;

// Tracks whether the user has interacted recently to temporarily disable auto scroll.
let lastInteract = 0;
// Rate limit for infinite scroll adjustments, in milliseconds.
let lastUpdate = 0;

//Duplicate first and last card to fake infinite scroll
carousel.insertBefore(cards[cards.length-1].cloneNode(true), cards[0]);
carousel.appendChild(cards[0].cloneNode(true));

function updateCarousel() {
  cards = [...carousel.children];
  const center = carousel.scrollLeft + carousel.clientWidth / 2;
  let closestIndex = firstValidCard;
  let closestDistance = Infinity;

  cards.forEach((card, index) => {
    const distance = Math.abs(center - (card.offsetLeft + card.clientWidth / 2));
    if (distance < closestDistance) {
      closestDistance = distance;
      closestIndex = index;
    }
  });

  /**
   * Infinite Scroll
   */
  if (closestIndex === 0) {
    carousel.scrollTo({
      left: cards[firstValidCard].clientWidth * (cards.length-2),
      behavior: 'instant'
    });
  } else if (closestIndex === cards.length - 1) {
    carousel.scrollTo({
      left: cards[firstValidCard].clientWidth,
      behavior: 'instant'
    });
  }
}

// Keyboard navigation: left/right arrows move by one card width relative to the current center card.
document.addEventListener('keydown', (e) => {
  if (e.code === "ArrowLeft" || e.code === "ArrowRight") {
    cards = [...carousel.children];
    const center = carousel.scrollLeft + carousel.clientWidth / 2;
    let closestIndex = firstValidCard;
    let closestDistance = Infinity;

    cards.forEach((card, index) => {
      const distance = Math.abs(center - (card.offsetLeft + card.clientWidth / 2));
      if (distance < closestDistance) {
        closestDistance = distance;
        closestIndex = index;
      }
    });
    if (e.code === "ArrowLeft") carousel.scrollLeft -= cards[closestIndex].clientWidth;
    if (e.code === "ArrowRight") carousel.scrollLeft += cards[closestIndex].clientWidth;
  }
});

carousel.addEventListener('scroll', () => {
  // Keep auto-scroll paused for a few interval ticks after user interaction.
  lastInteract = 5;
  updateCarousel();
  /**
   * Animate Carousel Cards
   *
   * Cards closer to the horizontal center appear larger and more opaque.
   * Farther cards are scaled down, faded, and given a slight blur effect.
   */
  cards.forEach(card => {
    const center = carousel.scrollLeft + carousel.clientWidth / 2;
    const cardCenter = card.offsetLeft + card.offsetWidth / 2;
    const distance = Math.abs(center - cardCenter);

    const scale = Math.max(0.8, 1 - distance / 1000);
    const opacity = Math.max(0.4, 1 - distance / 1000);
    const blur = Math.min(0.1, distance / 1000);

    card.style.transform = `scale(${scale})`;
    card.style.opacity = opacity;
    card.style.filter = `blur(${blur}rem)`;
  });

}, { passive: true });

/**
 * Scroll to first valid card on page load.
 * This ensures the carousel starts centered on the first actual item,
 * and not on the sentinel blank card used for looping.
 */
window.addEventListener('load', () => {
  carousel.scrollTo({
    left: cards[firstValidCard+1].offsetLeft - (carousel.clientWidth - cards[firstValidCard+1].clientWidth) / 2,
    behavior: 'smooth'
  });
});

/**
 * Auto Scroll
 *
 * If the user has not interacted recently, the carousel will automatically
 * advance to the next card every second.
 */
setInterval(() => {
  if (lastInteract > 0) lastInteract--;
  else {
    cards = [...carousel.children];
    const center = carousel.scrollLeft + carousel.clientWidth / 2;
    let closestIndex = firstValidCard;
    let closestDistance = Infinity;

    cards.forEach((card, index) => {
      const distance = Math.abs(center - (card.offsetLeft + card.clientWidth / 2));
      if (distance < closestDistance) {
        closestDistance = distance;
        closestIndex = index;
      }
    });
    carousel.scrollLeft += cards[closestIndex].clientWidth;
  }
}, 1000);