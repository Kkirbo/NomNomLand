
async function checkUserStatus() {
    try {
        const response = await fetch('../api/check-status.php');
        const data = await response.json();
        if (data.status === 'blocked' || data.status === 'deactivated') {
            window.location.href = 'logout.php?error=blocked';
        }
    } catch (error) {
        console.error("Status check failed:", error);
    }
}
setInterval(checkUserStatus, 1000);