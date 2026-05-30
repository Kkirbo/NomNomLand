export async function addArticleToCart(form) {
  const formData = new FormData(form);
  try {
    const GET_PARAMS_FROM_FORM = new URLSearchParams(formData);
    const response = await fetch(`../api/request-add-to-cart.php?${GET_PARAMS_FROM_FORM}`);
    return await response.text();
  } catch (e) {
    console.error(e);
    return null;
  }
}