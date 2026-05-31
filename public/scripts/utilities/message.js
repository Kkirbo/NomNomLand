//Generate a span element and attach it as a floating message above the provided element, then remove it after timer seconds
export function appendMessage(Element, text, timer=5, error=false) {
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
    const oldMessages = anchor.querySelectorAll(".floating-message");
    oldMessages.forEach(msg => msg.remove());
    anchor.appendChild(message);
    setTimeout(() => {
        message.classList.add("fade-out");
        message.addEventListener("transitionend", () => message.remove());
    }, timer*1000);
}

//Generate a div notification in the bottom left corner, then remove it after timer seconds
export function sendUserNotification(html, timer=5, error=false) {
    let container = document.querySelector(".notification-container");
    if (!container) {
        container = document.createElement("div");
        container.className = "notification-container";
        document.body.appendChild(container);
    }

    const notification = document.createElement("div");
    notification.className = "notification modernNeonBoxGlass";
    if (error) notification.classList.add("pastel-red");
    notification.innerHTML = html;

    container.appendChild(notification);
    setTimeout(() => {
        notification.classList.add("fade-out");
        notification.addEventListener("transitionend", () => {
            notification.remove();
            if (container.children.length <= 0) container.remove();
        });
    }, timer*1000);
}