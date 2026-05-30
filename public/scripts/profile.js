import { getUserId } from "./get-user-id.js";
import { requestProfileUpdate } from "./request-profile-update.js";
import "./editable-user-text-info.js";
import "./display-latest-order.js";


const form = document.querySelector("form.cookie-settings");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const cookies = {
    analyticsCookies: form.analyticsCookies.checked,
    functionalCookies: form.functionalCookies.checked
  };

  try {
    let userIdRequest = await getUserId();
    if (!userIdRequest || userIdRequest.status != 200 || !userIdRequest.id) return;
    let answer = await requestProfileUpdate(userIdRequest.id, "cookies", encodeURIComponent(JSON.stringify(cookies)));
  } catch (error) {}
});