<?php require_once '../../private/php/session.php';?>
<?php
$cookieConsent = $_COOKIE['cookie_consent'] ?? '';
?>
<?php
$user = get_user_by_session();
if (!$cookieConsent): ?>
<link rel="stylesheet" href="../styles/index.css">
<section class="modernNeonBoxGlass" id="cookiesBanner">
    <h1>Cookies</h1>

    <p>
        We use cookies to improve your experience. You can accept or reject non-essential cookies.
    </p>
    <p>
        <a href="cookies.php">How and why do we use cookies?</a>
        <a href="privacy.php">Privacy Policy</a>
    </p>
    <p>
        <button id="accept-cookies">Accept All</button>
        <button id="reject-cookies">Accept Only Essentials</button>
    </p>
</section>
<script>
document.querySelector('#accept-cookies')?.addEventListener('click', () => {
    document.cookie = `cookie_consent=accepted; path=/; max-age=${60 * 60 * 24 * 365}`;
    location.reload();
});
document.querySelector('#reject-cookies')?.addEventListener('click', () => {
    document.cookie = `cookie_consent=rejected; path=/; max-age=${60 * 60 * 24 * 365}`;
    location.reload();
});
</script>
<?php endif; ?>