/**
 * Carousel Lock In Between Blank Elements
 */
const carousel = document.querySelector('.carousel');
const cards = [...carousel.children];
const firstValidCard = 1;
const lastValidCard = cards.length - 2;

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
}, { passive: true });

window.addEventListener('load', () => {
  carousel.scrollTo({
    left: cards[firstValidCard].offsetLeft - (carousel.clientWidth - cards[firstValidCard].clientWidth) / 2,
    behavior: 'smooth'
  });
});

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

/**
 * Canvas animations
 */
/*
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
  pos[0] += 1;
  pos[1] += 1;
  ctx.restore();

  ctx.restore();

  window.requestAnimationFrame(draw);
}

window.requestAnimationFrame(draw);*/
