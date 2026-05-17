import "./editable-user-text-info.js";

import "./display-latest-order.js";


/*
document.addEventListener("click", async (e) => {
  // CLICK SUR EDIT
  if (e.target.classList.contains("edit-btn")) {
    const row = e.target.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const field = row.dataset.field;

    const currentValue = valueSpan.childNodes[0].textContent.trim();

    valueSpan.innerHTML = `
      <input type="text" value="${currentValue}" />
      <button class="save-btn">💾</button>
      <button class="cancel-btn">❌</button>
    `;
  }

  // CLICK SUR SAVE
  if (e.target.classList.contains("save-btn")) {
    const row = e.target.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const field = row.dataset.field;
    const input = valueSpan.querySelector("input");

    const newValue = input.value;

    const res = await fetch("../../private/php/update_profile.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ field, value: newValue })
    });

    const data = await res.json();

    if (data.success) {
      valueSpan.innerHTML = `
        ${newValue}
        <button class="edit-btn">✏️</button>
      `;
    }
  }

  // CLICK SUR CANCEL
  if (e.target.classList.contains("cancel-btn")) {
    const row = e.target.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const original = valueSpan.querySelector("input").defaultValue;

    valueSpan.innerHTML = `
      ${original}
      <button class="edit-btn">✏️</button>
    `;
  }
});
*/