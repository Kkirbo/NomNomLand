//Generate a span element and attach it as a floating message above the provided element, then remove it after 7 seconds
export function appendMessage(Element, text, error=false) {
    const message = document.createElement("span");
    message.className = "floating-message";
    if (error) message.classList.add("pastel-red");
    message.textContent = text;

    let anchor = Element;
    if (Element instanceof HTMLInputElement || Element instanceof HTMLTextAreaElement || Element instanceof HTMLSelectElement) {
        let wrapper = Element.parentElement;

        if (!wrapper?.classList.contains("input-container")) {
            wrapper = document.createElement("div");
            wrapper.className = "input-container";

            Element.parentNode.insertBefore(wrapper, Element);
            wrapper.appendChild(Element);
        }

        anchor = wrapper;
    }
    if (getComputedStyle(anchor).position != "relative") anchor.style.position = "relative";
    anchor.appendChild(message);

    setTimeout(() => message.remove(), 7000);
}
