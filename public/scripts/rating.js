
async function updateOrderStatus(orderId, newStatus) {
    try {
        const response = await fetch("../../private/php/update_order_status.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                order_id: orderId,
                status: newStatus
            })
        });
        const data = await response.json();
        if (data.success) {I
        } else {
            console.error("Erreur :", data.message);
        }
    } catch (error) {
        console.error("Erreur réseau :", error);
    }
