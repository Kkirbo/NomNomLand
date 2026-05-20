async function checkUserStatus() {

    try {

        const response = await fetch('../api/check-status.php');
        const data = await response.json();
        if (data.status === 'blocked') {
            console.log("Your account has been blocked.");
            /*window.location.href ='login.php?error=blocked'*/;
        }

    } catch (error) {
        console.error(error);
    }
}

setInterval(checkUserStatus, 10000);