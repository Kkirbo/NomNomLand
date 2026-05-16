export async function getUserId() {
  try {
    const response = await fetch(`../api/fetch-user-id.php`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}