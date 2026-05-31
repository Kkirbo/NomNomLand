<?php
require '../../private/php/session.php';
require '../../private/php/utilities/data.php';

$user = get_user_by_session();
if (!$user) redirect_url("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recovery</title>

    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">

    <script defer type="module" src="../scripts/recovery.js"></script>
    <script defer type="module" src="../scripts/form.js"></script>
</head>

<body>

<?php include 'header.html'; ?>
<?php include 'sidebar.php'; ?>

<main>

<form id="recoveryForm" class="validateForm modernNeonBox">

    <h2>Reset password</h2>

    <div class="field">
        <label>New password</label>
        <div class="password-field">
            <input type="checkbox" name="togglePassword" id="togglePassword">
            <label for="togglePassword">👁</label>

            <span class="valueLength"><span>0</span>/100</span>

            <input id="password" name="password" type="password" maxlength="100" required>
        </div>
    </div>

    <div class="field">
        <label>Confirm password</label>
        <div class="password-field">
            <input type="checkbox" name="togglePassword" id="togglePassword2">
            <label for="togglePassword2">👁</label>

            <span class="valueLength"><span>0</span>/100</span>

            <input id="confirmPassword" name="confirmPassword" type="password" maxlength="100" required>
        </div>
    </div>

    <button type="submit" class="button">Reset</button>

</form>

</main>

<?php include 'footer.html'; ?>

</body>
</html>