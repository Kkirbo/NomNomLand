export async function getModalInfo(type, id) {
  try {
    const response = await fetch(`../api/fetch-modal-info.php?type=${type}&id=${id}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}