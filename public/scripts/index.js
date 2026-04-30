/**
 * Carousel
 */
const carousel = document.querySelector('section.carousel');
const cards = [...carousel.children];
const firstValidCard = 1;
const lastValidCard = cards.length - 2;

let lastUpdate = 0;
carousel.addEventListener('scroll', () => {
  /**
   * Lock In Between Blank Elements
   */
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
 
 if (closestIndex === 1) {
  if (Date.now() - lastUpdate > 500) {
    const lastCard = carousel.children[lastValidCard];

    const prevOffset = lastCard.offsetLeft;

    carousel.insertBefore(lastCard, carousel.children[firstValidCard]);

    carousel.scrollLeft += lastCard.clientWidth;
    lastUpdate = Date.now();
  }
} 
if (closestIndex === cards.length - 2) {
  if (Date.now() - lastUpdate > 500) {
    const firstCard = carousel.children[firstValidCard];

    const prevOffset = firstCard.offsetLeft;

    carousel.insertBefore(firstCard, carousel.children[lastValidCard + 1]);

    carousel.scrollLeft -= firstCard.clientWidth;
    lastUpdate = Date.now();
  }
}


  /**
   * Animate Carousel Cards
   */
  cards.forEach(card => {
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