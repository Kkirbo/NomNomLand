import { requestProfileUpdate } from "./request-profile-update.js";
import { appendMessage } from "./utilities/message.js";
import "./editable-user-text-info.js";

const scrollCollisionWidth = 40; //Width of the side rectangles that will scroll the dashboard left or right if the cursor is in it
const scrollSpeed = 10; //Pixels to jump with each scroll step (keys or mouse)

const dashboard = document.querySelector('section.infos article:has(table)');
let scrollKeys = [false, false]
let mouseCollision = 0;
document.addEventListener('keydown', (e) => {
    if (e.keyCode !== 37 && e.keyCode !== 39) return;
    e.preventDefault();
    if (e.keyCode === 37) scrollKeys[0] = true;
    if (e.keyCode === 39) scrollKeys[1] = true;
});
document.addEventListener('keyup', (e) => {
    if (e.keyCode !== 37 && e.keyCode !== 39) return;
    e.preventDefault();
    if (e.keyCode === 37) scrollKeys[0] = false;
    if (e.keyCode === 39) scrollKeys[1] = false;
});
document.addEventListener('mousemove', (e) => {
    mouseCollision = 0;
    let dashboardRect = dashboard.getBoundingClientRect();
    if (e.pageY >= dashboardRect.y && e.pageY <= dashboardRect.y + dashboardRect.height) {
        if (e.pageX >= dashboardRect.x && e.pageX <= dashboardRect.x + scrollCollisionWidth)
            mouseCollision = -1;
        else if (e.pageX <= dashboardRect.x + dashboardRect.width && 
            e.pageX >= dashboardRect.x + dashboardRect.width - scrollCollisionWidth)
            mouseCollision = 1;
    }
});
setInterval(() => {
    if (scrollKeys[0]) dashboard.scrollLeft -= scrollSpeed;
    if (scrollKeys[1]) dashboard.scrollLeft += scrollSpeed;
    if (mouseCollision != 0) dashboard.scrollLeft += scrollSpeed * mouseCollision;
}, 10);

const tbody = dashboard.querySelector('table tbody');
const users = tbody.querySelectorAll('tr');

for (const user of users) {
    const userId = user.querySelector('td:first-child span[data-name="id"]')?.textContent.trim().toLowerCase();
    if (!userId) continue;
    
    const roleSelect = user.querySelector('select[name="role"]');
    let roleSelectOldValue = roleSelect ? roleSelect.value : undefined;
    if (roleSelect) roleSelect.addEventListener('change', async (e) => {
        const updated = await requestProfileUpdate(userId, "role", e.target.value);
        if (!updated || updated.status != 200) {
            roleSelect.value = roleSelectOldValue;
            appendMessage(roleSelect, updated.error ?? "Failed to update profile", 7, true);
            return;
        }
        roleSelectOldValue = roleSelect.value;
    });

    async function statusChange() {
        const updated = await requestProfileUpdate(userId, "status", statusSelect.value);
        if (!updated || updated.status != 200) {
            statusSelect.value = statusSelectOldValue;
            appendMessage(statusSelect, updated.error ?? "Failed to update profile", 7, true);
            return;
        }
        statusSelectOldValue = statusSelect.value;
    }
    const statusSelect = user.querySelector('select[name="status"]');
    let statusSelectOldValue = statusSelect ? statusSelect.value : undefined;
    if (statusSelect) statusSelect.addEventListener('change', async (e) => {
        statusChange();
    });

    const block = user.querySelector('td:last-child.actions button[name="block"]');
    if (block) block.addEventListener('click', (e) => {
        if (statusSelect) {
            statusSelect.value = "blocked";
            statusChange();
        }
    });
    const deactivate = user.querySelector('td:last-child.actions button[name="deactivate"]');
    if (deactivate) deactivate.addEventListener('click', (e) => {
        if (statusSelect) {
            statusSelect.value = "deactivated";
            statusChange();
        }
    });

    const pointsController = user.querySelector('div.points-control');
    const pointsSpan = pointsController.querySelector('span.points');
    const minusButton = pointsController.querySelector('button[name=minusfidelity]');
    const plusButton = pointsController.querySelector('button[name=plusfidelity]');

    if (minusButton) minusButton.addEventListener("click", async (e) => {
        const newPoints = parseInt(pointsSpan.textContent) - 1 * (e.ctrlKey ? 100 : 1) * (e.shiftKey ? 10 : 1);
        const updated = await requestProfileUpdate(userId, "fidelity", newPoints);
        if (updated && updated.status == 200) pointsSpan.textContent = newPoints;
    });

    if (plusButton) plusButton.addEventListener("click", async (e) => {
        const newPoints = parseInt(pointsSpan.textContent) + 1 * (e.ctrlKey ? 100 : 1) * (e.shiftKey ? 10 : 1);
        const updated = await requestProfileUpdate(userId, "fidelity", newPoints);
        if (updated && updated.status == 200) pointsSpan.textContent = newPoints;
    });
}