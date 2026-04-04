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
                        <?php foreach ($users as $u): 
                            $isAdmin = $u['role'] === 'admin';
                        ?>
                        <tr>
                            <td><span><?= htmlspecialchars($u['id']) ?></span></td>
                            <td><span><?= htmlspecialchars($u['profile']['lastName']) . " " . htmlspecialchars($u['profile']['firstName']) ?></span></td>
                            <td><span><?= htmlspecialchars($u['profile']['username']) ?></span></td>
                            <td><span><?= htmlspecialchars($u['email']) ?></span></td>

                            <td>
                                <?php if ($isAdmin): ?>
                                    <select class="role-select pastel-red" disabled>
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

                            <td>
                                <?php if ($isAdmin): ?>
                                    <select class="status-select pastel-red" disabled>
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

                            <td class="actions">
                                <?php if (!$isAdmin): ?>
                                    <button class="pastel-red">Block</button>
                                    <button class="pastel-orange">Deactivate</button>
                                <?php else: ?>
                                    <button class="pastel-red admin-locked">Admin</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>

    <?php include 'footer.html'; ?>

</body>
</html>
