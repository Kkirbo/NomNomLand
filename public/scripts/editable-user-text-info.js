import { getUserId } from "../scripts/get-user-id.js";
import { requestProfileUpdate } from "./request-profile-update.js";
import { appendMessage } from "./utilities/appendMessage.js";
import { checkLength, validateInput } from "./form.js";

const sidebarCheckbox = document.querySelector('#togglesidebar');

function cancelInput(input) {
    if (!input) return;
    const span = document.createElement("span");
    span.className = "editable-user-text-info";
    span.dataset.id = input.dataset.id;
    span.dataset.name = input.dataset.name;
    span.textContent = input.placeholder;
    input.replaceWith(span);
}

async function submitInput(input) {
    if (!input) return;
    const span = document.createElement("span");
    span.className = "editable-user-text-info";
    span.dataset.id = input.dataset.id;
    span.dataset.name = input.dataset.name;
    span.textContent = input.placeholder;

    let validate = validateInput(input);
    if (!validate.success) {
        input.replaceWith(span);
        appendMessage(span, validate.error, true);
        return;
    }

    let userId = {status: 200, id: input?.dataset?.id};
    if (!userId) userId = await getUserId();
    if (!userId || userId.status != 200 || !userId.id) {
        input.replaceWith(span);
        appendMessage(span, "Failed to get user ID", true);
        return;
    }
    userId = userId.id;
    
    const updated = await requestProfileUpdate(userId, span.dataset.name, input.value);
    if (!updated || updated.status != 200) {
        input.replaceWith(span);
        appendMessage(span, updated.error ?? "Failed to update profile", true);
        return;
    }

    span.textContent = input.value;
    input.replaceWith(span);
}

document.addEventListener("keydown", (e) => {
    const activeInputs = document.querySelectorAll("input.editing-user-text-info");
    if (e.keyCode == 27) {
        let canceledInput = false;
        for (const activeInput of activeInputs) if (activeInput) {
            cancelInput(activeInput);
            canceledInput = true;
        }
        if (sidebarCheckbox && canceledInput) setTimeout(() => sidebarCheckbox.checked = !sidebarCheckbox.checked, 1);
    }
    if (e.keyCode == 13) for (const activeInput of activeInputs) if (activeInput) submitInput(activeInput);
});

document.addEventListener("click", async (e) => {
    const activeInputs = document.querySelectorAll("input.editing-user-text-info");
    for (const activeInput of activeInputs) if (activeInput && !activeInput.contains(e.target)) submitInput(activeInput);

    const span = e.target.closest("span.editable-user-text-info");
    if (!span) return;

    const input = document.createElement("input");
    input.className = "editing-user-text-info";
    input.type = span.dataset.name == "phone" ? "tel" : span.dataset.name == "email" || span.dataset.name == "password" ? span.dataset.name : "text";
    input.value = span.firstChild.textContent.trim();
    input.placeholder = span.firstChild.textContent.trim();
    input.dataset.id = span.dataset.id;
    input.dataset.name = span.dataset.name;
    
    input.style.font = getComputedStyle(span).font;

    span.replaceWith(input);
    input.focus();
});