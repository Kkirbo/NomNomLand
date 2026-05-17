export async function getSearchResult(form) {
  const formData = new FormData(form);
  try {
    const GET_PARAMS_FROM_URL = new URLSearchParams(window.location.search);
    const sort = GET_PARAMS_FROM_URL.get("sort") ?? "";
    const invert = GET_PARAMS_FROM_URL.get("invert") ?? "";
    const GET_PARAMS_FROM_FORM = new URLSearchParams(formData);
    //Sorting is client side update the address but don't send to server
    history.replaceState(null, "", `?${GET_PARAMS_FROM_FORM}${sort!="" ? "&sort=" + sort : ""}${invert!="" ? "&invert=" + invert : ""}`);
    const response = await fetch(`../api/fetch-search-results.php?${GET_PARAMS_FROM_FORM}`);
    return await response.text();
  } catch (e) {
    console.error(e);
    return null;
  }
}