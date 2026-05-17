import "./display-latest-order.js";

import { requestOrderUpdate } from "./request-order-update.js";

function initRatingForm() {

    const form = document.getElementById("rating-form");

    if (!form) return;

    form.addEventListener("submit", async function (e) {

        console.log(lastOrder);
        

        e.preventDefault();

        const questions = ["q1", "q2", "q3", "q4", "q5"];

        const rating = {};

        questions.forEach(q => {

            const checked = document.querySelector(
                `input[name="rating-${q}"]:checked`
            );

            rating[q] = checked
                ? parseInt(checked.value)
                : null;
        });

        console.log(rating);

        console.log(lastOrder);
        const orderId = lastOrder["id"];

        const delivery_status_updated = await requestOrderUpdate(
            encodeURIComponent(orderId), 
            encodeURIComponent("rating"), 
            encodeURIComponent(JSON.stringify(rating))
        );
        console.log(delivery_status_updated.status);

        const form = document.getElementById("rating-form-wrapper");

        form.innerHTML = `
            <div>
                <h3>Merci pour votre retour !</h3>
            </div>
        `;
        
        if (!delivery_status_updated || delivery_status_updated.status != 200) {
            return;
        }

    });
}

initRatingForm();