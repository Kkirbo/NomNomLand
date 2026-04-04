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
        <h1>Admin Dashboard</h1>

        <section class="modernNeonBoxGlass admin-panel">
            <h2>Users Management</h2>

            <table class="admin-table">
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
                    <?php foreach ($users as $u): 
                        $isAdmin = $u['role'] === 'admin';
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['profile']['lastName']) . " " . htmlspecialchars($u['profile']['firstName']) ?></td>
                        <td><?= htmlspecialchars($u['profile']['username']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>

                        <!-- ROLE -->
                        <td>
                            <?php if ($isAdmin): ?>
                                <select class="role-select role-admin" disabled>
                                    <option selected>Admin</option>
                                </select>
                            <?php else: ?>
                                <select class="role-select">
                                    <option value="client" <?= $u['role'] === 'client' ? 'selected' : '' ?>>Client</option>
                                    <option value="delivery" <?= $u['role'] === 'delivery' ? 'selected' : '' ?>>Delivery</option>
                                    <option value="cook" <?= $u['role'] === 'cook' ? 'selected' : '' ?>>Cook</option>
                                </select>
                            <?php endif; ?>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php if ($isAdmin): ?>
                                <select class="status-select role-admin" disabled>
                                    <option selected><?= ucfirst(htmlspecialchars($u['status'])) ?></option>
                                </select>
                            <?php else: ?>
                                <select class="status-select">
                                    <option value="free" <?= $u['status'] === 'free' ? 'selected' : '' ?>>Free</option>
                                    <option value="premium" <?= $u['status'] === 'premium' ? 'selected' : '' ?>>Premium</option>
                                    <option value="vip" <?= $u['status'] === 'vip' ? 'selected' : '' ?>>VIP</option>
                                    <option value="blocked" <?= $u['status'] === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                                    <option value="deactivated" <?= $u['status'] === 'deactivated' ? 'selected' : '' ?>>Deactivated</option>
                                </select>
                            <?php endif; ?>
                        </td>

                        <!-- POINTS (editable UI) -->
                        <td>
                            <div class="points-control">
                                <?php if (!$isAdmin): ?>
                                    <button class="points-btn minus">−</button>
                                <?php endif; ?>

                                <span class="points">
                                    <?= isset($u['points']) ? intval($u['points']) : 0 ?>
                                </span>

                                <?php if (!$isAdmin): ?>
                                    <button class="points-btn plus">+</button>
                                <?php endif; ?>
                            </div>
                        </td>

                        <!-- ACTIONS -->
                        <td class="actions">
                            <?php if (!$isAdmin): ?>
                                <button class="danger">Block</button>
                                <button class="warning">Deactivate</button>
                            <?php else: ?>
                                <span class="badge role-admin">Admin</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php include 'footer.html'; ?>

</body>
</html>
