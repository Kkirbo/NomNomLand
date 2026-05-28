import "./editable-user-text-info.js";

import "./display-latest-order.js";

import { requestProfileUpdate } from "./request-profile-update.js";

const form = document.querySelector("form.cookie-settings");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const cookies = {
    analyticsCookies: form.analyticsCookies.checked,
    functionalCookies: form.functionalCookies.checked
  };

  try {
    await requestProfileUpdate(user_id, "cookies", encodeURIComponent(JSON.stringify(cookies)));
  } catch (error) {}
});