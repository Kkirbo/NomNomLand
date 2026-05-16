import { requestProfileUpdate } from "./request-profile-update.js";
import "./editable-user-text-info.js";

const tbody = document.querySelector('section.infos article table tbody');
const users = tbody.querySelectorAll('tr');

for (const user of users) {
    const userId = user.querySelector('td:first-child span#id')?.textContent.trim().toLowerCase();
    if (!userId) continue;
    
    const roleSelect = user.querySelector('select[name="role"]');
    let roleSelectOldValue = roleSelect ? roleSelect.value : undefined;
    if (roleSelect) roleSelect.addEventListener('change', async (e) => {
        const updated = await requestProfileUpdate(userId, "role", e.target.value);
        if (!updated || updated.status != 200) {
            roleSelect.value = roleSelectOldValue;
            return;
        }
        roleSelectOldValue = roleSelect.value;
    });

    const statusSelect = user.querySelector('select[name="status"]');
    let statusSelectOldValue = statusSelect ? statusSelect.value : undefined;
    if (statusSelect) statusSelect.addEventListener('change', async (e) => {
        const updated = await requestProfileUpdate(userId, "status", e.target.value);
        if (!updated || updated.status != 200) {
            statusSelect.value = statusSelectOldValue;
            return;
        }
        statusSelectOldValue = statusSelect.value;
    });

    const block = user.querySelector('td:last-child.actions button[name="block"]');
    if (block) block.addEventListener('click', (e) => {
        if (statusSelect) statusSelect.value = "blocked";
    });
    const deactivate = user.querySelector('td:last-child.actions button[name="deactivate"]');
    if (deactivate) deactivate.addEventListener('click', (e) => {
        if (statusSelect) statusSelect.value = "deactivated";
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