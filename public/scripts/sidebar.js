import { setCookie, getCookie } from './cookies.js';

const htmlElement = document.children[0];

const sidebarCheckbox = document.querySelector('#togglesidebar');
const sidebar = document.querySelector('.sidebar');

//Hide sidebar when clicking outside
document.addEventListener('click', (e) => {
  if (!sidebarCheckbox.checked) return;
  if (!sidebar.contains(e.target) && !e.target.matches('.togglesidebar, .togglesidebar *')) {
    sidebarCheckbox.checked = false;
  }
});

//Escape key to toggle sidebar
document.addEventListener('keydown', (e) => {
  if (e.keyCode === 27) sidebarCheckbox.checked = !sidebarCheckbox.checked;
});

//Change theme when toggling button in sidebar
const changeThemeButton = document.querySelector('#holo-toggle');
changeThemeButton.checked = getCookie("theme") == null || getCookie("theme") == "dataTheme";
function updateTheme() {
  if (changeThemeButton.checked) htmlElement.classList.remove("richTheme");
  else htmlElement.classList.add("richTheme");
  setCookie("theme", changeThemeButton.checked ? "dataTheme" : "richTheme", 60*60*24*365);
}
updateTheme();
changeThemeButton.addEventListener('change', updateTheme);

//Disco theme easter egg
let clicksCounter = 0;
setInterval(() => {
  if (clicksCounter >= 12) htmlElement.classList.add("discoTheme");
  clicksCounter = 0;
}, 2000);
changeThemeButton.addEventListener('click', () => clicksCounter++);
