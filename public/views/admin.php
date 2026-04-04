<?php 
require '../../private/php/session.php';
require_login();
$user = get_user_by_session();
if ($user['role'] !== 'admin') redirect_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>

    <?php include 'header.html'; ?>

    <?php include 'sidebar.php'; ?>

    <main>
        <h1>Admin Page</h1>
    </main>

    <?php include 'footer.html'; ?>

</body>
</html>
