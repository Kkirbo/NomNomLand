import { getLastOrderInfo } from "../../scripts/get-order-info.js";

function updateOrderProgress(status) {

    const mapping = {
        pending: 0,
        preparing: 1,
        ready: 2,
        delivery: 3,
        success: 4,
        failed: 4
    };

    const currentStep = mapping[status];

    if (currentStep === undefined) {
        return;
    }

    const steps = document.querySelectorAll("#order-progress .step");

    steps.forEach((step, index) => {

        step.classList.remove("active");
        step.classList.remove("completed");

        if (index < currentStep) {
            step.classList.add("completed");
        }

        if (index === currentStep) {
            step.classList.add("active");
        }
    });

    const progressLine =
        document.querySelector(".progress-line-active");

    const percentages = [
        "0%",
        "20%",
        "40%",
        "60%",
        "80%",
        "100%"
    ];

    progressLine.style.width =
        percentages[currentStep];
}

async function refreshOrderStatus() {

    const progressContainer = document.getElementById("order-progress-container");
    
    const response = await getLastOrderInfo();

    if (
        !response ||
        !response.data ||
        !response.data.delivery
    ) {
        
        progressContainer?.classList.add("hidden");
        return;
    }

    progressContainer?.classList.remove("hidden");
    
    const status = response.data.delivery.status;

    updateOrderProgress(status);
}

refreshOrderStatus();

setInterval(refreshOrderStatus, 5000);