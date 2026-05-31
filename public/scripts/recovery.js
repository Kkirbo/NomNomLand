import { validateForm } from "./form.js";

const form = document.getElementById("recoveryForm");

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // ✅ utilise TON validation existante
    if (!validateForm(form)) return;

    const data = new FormData(form);

    const res = await fetch("../php/actions/recovery_action.php", {
        method: "POST",
        body: data
    });

    const json = await res.json();

    if (json.success) {
        window.location.href = "login.php";
    } else {
        alert(json.error);
    }
});