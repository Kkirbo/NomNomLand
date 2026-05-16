export async function requestProfileUpdate(userId, field, value) {
  try {
    const response = await fetch(`../api/request-profile-update.php?userId=${userId}&field=${field}&value=${value}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return false;
  }
}