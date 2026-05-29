export async function requestProfileUpdate(userId, field, value) {
  try {
    const query = new URLSearchParams({ userId, field, value });
    const response = await fetch(`../api/request-profile-update.php?${query}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return false;
  }
}