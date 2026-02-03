let sidbarButton = document.querySelector("#togglesidebar");
let sidebar = document.querySelector(".sidebar");

function toggleSidebar() {
  sidebar.classList.toggle("open");
  sidbarButton.style.display = sidebar.classList.contains("open") ? "none" : "block";
}

sidbarButton.addEventListener("click", toggleSidebar);
sidebar.firstElementChild.firstElementChild.addEventListener("click", toggleSidebar);
