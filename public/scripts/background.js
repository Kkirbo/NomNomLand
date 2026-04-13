
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
  pos[0] += 1;
  pos[1] += 1;
  ctx.restore();

  ctx.restore();

  window.requestAnimationFrame(draw);
}

window.requestAnimationFrame(draw);
