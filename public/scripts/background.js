import { Vector2 } from "./physics/math.js";
import { PhysicsObject } from "./physics/objects.js";
import { applyForce, integrate } from "./physics/physics.js";

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

const circle = new PhysicsObject(new Vector2(100, 100));
const floorY = canvas.height;

let lastTime = performance.now();
let accumulator = 0;
const fixedDt = 1 / 60;
const restitution = 0.7;

function update() {
    const now = performance.now();
    let frameTime = (now - lastTime) / 1000;
    lastTime = now;

    accumulator += frameTime;

    while (accumulator >= fixedDt) {
      applyForce(circle, new Vector2(0, 9.8));

      integrate(circle, fixedDt);

      // collision AFTER movement
      if (circle.position.y + circle.radius >= floorY) {

          circle.position.y = floorY - circle.radius;

          if (circle.velocity.y > 0) {
              circle.velocity.y *= -restitution;
          }
      }

      accumulator -= fixedDt;
  }

    setTimeout(update, 0);
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
