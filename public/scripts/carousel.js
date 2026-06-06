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
   * Snap to the nearest real card when the carousel is scrolled into a blank sentinel card.
   * The blank cards at index 0 and the last index are used to create the illusion of
   * an infinite loop while allowing a smooth transition back to the valid content range.
   */
  if (closestIndex === 0) {
    carousel.scrollTo({
      left: cards[firstValidCard].offsetLeft - (carousel.clientWidth - cards[firstValidCard].clientWidth) / 2,
      behavior: 'smooth'
    });
  } else if (closestIndex === cards.length - 1) {
    carousel.scrollTo({
      left: cards[lastValidCard].offsetLeft - (carousel.clientWidth - cards[lastValidCard].clientWidth) / 2,
      behavior: 'smooth'
    });
  }
 
  /**
   * Infinite Scroll
   */
  if (closestIndex === 1) {
    if (Date.now() - lastUpdate > 500) {
      lastUpdate = Date.now();
      // Move the last real card to the front to preserve the infinite-scroll illusion.
      let lastCard = carousel.children[cards.length - 2];
      let firstCard = carousel.children[1];
      carousel.insertBefore(lastCard, firstCard);
      cards = [...carousel.children];
      carousel.scrollTo({
        left: cards[2].offsetLeft - (carousel.clientWidth - cards[2].clientWidth) / 2,
        behavior: 'auto'
      });
    }
  }
  if (closestIndex === cards.length - 2) {
    if (Date.now() - lastUpdate > 500) {
      lastUpdate = Date.now();
      // Move the first real card to the end when scrolling toward the last real card.
      let lastCard = carousel.children[cards.length - 1];
      let firstCard = carousel.children[1];
      carousel.insertBefore(firstCard, lastCard);
      cards = [...carousel.children];
      carousel.scrollTo({
        left: cards[cards.length - 3].offsetLeft - (carousel.clientWidth - cards[cards.length - 3].clientWidth) / 2,
        behavior: 'auto'
      });
    }
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