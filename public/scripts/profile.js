document.querySelectorAll(".edit-btn").forEach(button => {
  button.addEventListener("click", () => {
    const row = button.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const field = row.dataset.field;

    const currentValue = valueSpan.childNodes[0].textContent.trim();

    valueSpan.innerHTML = `
      <input type="text" value="${currentValue}" />
      <button class="save-btn">save</button>
      <button class="cancel-btn">cancel</button>
    `;

    const input = valueSpan.querySelector("input");

    valueSpan.querySelector(".save-btn").addEventListener("click", async () => {
      const newValue = input.value;

      const res = await fetch("../../private/php/update_profile.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          field: field,
          value: newValue
        })
      });

      const data = await res.json();

      if (data.success) {
        valueSpan.innerHTML = `
          ${newValue}
          <button class="edit-btn">✏️</button>
        `;
      } else {
        alert("Erreur: " + data.error);
      }
    });

    valueSpan.querySelector(".cancel-btn").addEventListener("click", () => {
      valueSpan.innerHTML = `
        ${currentValue}
        <button class="edit-btn">✏️</button>
      `;
    });
  });
});