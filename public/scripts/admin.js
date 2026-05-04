const tbody = document.querySelector('section.infos article table tbody');
const users = tbody.querySelectorAll('tr');

for (const user of users) {
    const userId = user.querySelector('td:first-child span#id')?.innerHTML.trim().toLowerCase();
    const roleSelect = user.querySelector('select[name="role"]');
    const statusSelect = user.querySelector('select[name="status"]');
    const pointsController = user.querySelector('div.points-control');
    const block = user.querySelector('td:last-child.actions button[name="block"]');
    const deactivate = user.querySelector('td:last-child.actions button[name="deactivate"]');
}