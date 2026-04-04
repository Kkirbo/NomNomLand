<?php 
require '../../private/php/session.php';
require_login();
$user = get_user_by_session();
if (!$user || $user['role'] !== 'admin') redirect_url();
$users = get_users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>

    <?php include 'header.html'; ?>

    <?php include 'sidebar.php'; ?>

    <main>
        <section class="infos">
            <h2>Admin Dashboard</h2>
            <article class="modernNeonBoxGlass">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Points</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            include '../../private/php/generate-admin-table.php';
                            generateAdminTable($users);
                        ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>

    <?php include 'footer.html'; ?>

</body>
</html>
