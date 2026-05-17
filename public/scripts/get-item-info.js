export async function getItemInfo(id) {
  try {
    const response = await fetch(`../api/fetch-item-info.php?id=${id}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}