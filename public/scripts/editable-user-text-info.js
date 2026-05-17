import { getUserId } from "../scripts/get-user-id.js";
import { requestProfileUpdate } from "./request-profile-update.js";

document.addEventListener("click", async (e) => {
    const activeInputs = document.querySelectorAll("input.editing-user-text-info");
    for (const activeInput of activeInputs) 
    if (activeInput && !activeInput.contains(e.target)) {
        const span = document.createElement("span");
        span.className = "editable-user-text-info";
        span.dataset.id = activeInput.dataset.id;
        span.dataset.name = activeInput.dataset.name;
        span.textContent = activeInput.placeholder;

        let userId = {status: 200, id: activeInput?.dataset?.id};
        if (!userId) userId = await getUserId();
        if (!userId || userId.status != 200 || !userId.id) {
            activeInput.replaceWith(span);
            continue;
        }
        userId = userId.id;
        
        const updated = await requestProfileUpdate(userId, span.dataset.name, activeInput.value);
        if (!updated || updated.status != 200) {
            activeInput.replaceWith(span);
            continue;
        }

        span.textContent = activeInput.value;
        activeInput.replaceWith(span);
    }

    const span = e.target.closest("span.editable-user-text-info");
    if (!span) return;

    const input = document.createElement("input");
    input.className = "editing-user-text-info";
    input.type = "text";
    input.value = span.textContent;
    input.placeholder = span.textContent;
    input.dataset.id = span.dataset.id;
    input.dataset.name = span.dataset.name;
    
    input.style.font = getComputedStyle(span).font;
    //input.style.width = `${span.getBoundingClientRect().width}px`;

    span.replaceWith(input);
    input.focus();
});