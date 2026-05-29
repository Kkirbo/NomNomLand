async function checkUserStatus() {
    try {
        const response = await fetch('../api/check-status.php');
        const data = await response.json();
        if (data.redirect) {
            window.location.href = data.redirect;
            return;
        }
    } catch (error) {
        console.error("Status check failed:", error);
    }
}

setInterval(checkUserStatus, 10000);