export async function sendDataAsync(form) {
  const formData = new FormData(form);

  try {
    let GET_PARAMS = new URLSearchParams(formData);
    history.pushState(null, "", `${window.location.pathname}?${GET_PARAMS}`);
    const response = await fetch(`/private/php/generate-search-result.php?${GET_PARAMS}`);
    return await response.text();
  } catch (e) {
    console.error(e);
  }
}