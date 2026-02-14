const carousel = document.querySelector('.carousel');
const cards = [...carousel.children];
const firstValidCard = 1;
const lastValidCard = cards.length - 2;

// Block scroll on blank elements and constrain to valid cards only
carousel.addEventListener('scroll', () => {
  const scrollCenter = carousel.scrollLeft + carousel.clientWidth / 2;
  let closestIndex = firstValidCard;
  let closestDistance = Infinity;
  
  cards.forEach((card, index) => {
    const distance = Math.abs(scrollCenter - (card.offsetLeft + card.clientWidth / 2));
    if (distance < closestDistance) {
      closestDistance = distance;
      closestIndex = index;
    }
  });
  
  // If on blank cards, snap back to nearest valid card
  if (closestIndex === 0) {
    cards[firstValidCard].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  } else if (closestIndex === cards.length - 1) {
    cards[lastValidCard].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  }
}, { passive: true });

// Initial scroll
window.addEventListener('load', () => {
  cards[firstValidCard].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
});


/**
 * Canvas animations
 */
const canvas = document.querySelector('canvas');
canvas.style.top = "0px";
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let pos = [-5, -5];

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.save();

    ctx.save();
    ctx.fillStyle = 'rgb(190, 25, 25)';
    ctx.fillRect(pos[0], pos[1], 10, 10);
    ctx.restore();

    ctx.restore();

    window.requestAnimationFrame(draw);
}

window.requestAnimationFrame(draw);


