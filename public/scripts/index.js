/**
 * Carousel
 */
const carousel = document.querySelector('section.carousel');
let cards = [...carousel.children];
const firstValidCard = 1;
const lastValidCard = cards.length - 2;

let lastInteract = 0;

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
   * Lock In Between Blank Elements
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

document.addEventListener('keydown', (e) => {
  if (e.keyCode === 37 || e.keyCode === 39) {
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
    if (e.keyCode === 37) carousel.scrollLeft -= cards[closestIndex].clientWidth;
    if (e.keyCode === 39) carousel.scrollLeft += cards[closestIndex].clientWidth;
  }
});

carousel.addEventListener('scroll', () => {
  lastInteract = 5;
  updateCarousel();
  /**
   * Animate Carousel Cards
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

window.addEventListener('load', () => {
  carousel.scrollTo({
    left: cards[firstValidCard+1].offsetLeft - (carousel.clientWidth - cards[firstValidCard+1].clientWidth) / 2,
    behavior: 'smooth'
  });
});

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