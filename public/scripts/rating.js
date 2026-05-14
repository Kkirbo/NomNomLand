async function refreshOrderPreview() {
const res = await fetch("/public/api/get-latest-command.php");
    const data = await res.json();
    if (!data.success) return;
    const container = document.getElementById("order-container");
    if (!container) return;
    let html = "";
    for (const dish of data.dishes) {
    html += `
        <div class="order-preview">
            <img src="${dish.image}" alt="${dish.title}">
            <div class="infos">
                <span class="title">${dish.title}</span>
                <span class="meta">${dish.version}</span>
                <span class="price">x${dish.quantity} • ${dish.price}€</span>
            </div>
        </div>
    `;
}
    container.innerHTML = html;
}
setInterval(refreshOrderPreview, 3000);
refreshOrderPreview();
