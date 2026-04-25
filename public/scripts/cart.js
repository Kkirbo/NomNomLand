function updateTotal() {
    let total = 0;
    cart.forEach(item => {
        total += item.price * item.quantity;
    });
    document.getElementById("total").innerText = total.toFixed(2) + " €";
}