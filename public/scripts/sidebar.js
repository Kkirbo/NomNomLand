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
changeThemeButton.checked = getCookie("theme") == "dataTheme";
function changeTheme() {
  if (changeThemeButton.checked) htmlElement.classList.remove("richTheme");
  else htmlElement.classList.add("richTheme");
  setCookie("theme", changeThemeButton.checked ? "richTheme" : "dataTheme", 60*60*24*365);
}
changeTheme();
changeThemeButton.addEventListener('change', changeTheme);
