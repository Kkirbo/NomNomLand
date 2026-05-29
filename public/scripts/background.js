/**
 * Canvas animations
 */
const canvas = document.querySelector('canvas');
canvas.style.top = "0px";
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

export function drawCircle(ctx, obj, radius = 10) {
    ctx.beginPath();
    ctx.arc(obj.position.x, obj.position.y, radius, 0, Math.PI * 2);
    ctx.fill();
}

function update() {

    setTimeout(update, 1/20);
}

update();

function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  ctx.save();

  ctx.save();
  drawCircle(ctx, circle, 10);
  ctx.restore();

  ctx.restore();

  window.requestAnimationFrame(draw);
}

window.requestAnimationFrame(draw);
