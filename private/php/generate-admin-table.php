<?php
function generateAdminTable($users)
{
    foreach ($users as $user) {
        $isAdmin = $user['role'] === 'admin';

        echo '<tr>';

        echo '<td><span id="id">' . htmlspecialchars($user['id']) . '</span></td>';
        echo '<td><span>' . htmlspecialchars($user['profile']['lastName']) . ' ' . htmlspecialchars($user['profile']['firstName']) . '</span></td>';
        echo '<td><span>' . htmlspecialchars($user['profile']['username']) . '</span></td>';
        echo '<td><span>' . htmlspecialchars($user['email']) . '</span></td>';

        echo '<td>';
        if ($isAdmin) {
            echo '<select name="disabled" class="pastel-red" disabled>';
            echo '<option selected>Admin</option>';
            echo '</select>';
        } else {
            echo '<select name="role">';
            echo '<option value="client"' . ($user['role'] === 'client' ? ' selected' : '') . '>Client</option>';
            echo '<option value="delivery"' . ($user['role'] === 'delivery' ? ' selected' : '') . '>Delivery</option>';
            echo '<option value="cook"' . ($user['role'] === 'cook' ? ' selected' : '') . '>Cook</option>';
            echo '</select>';
        }
        echo '</td>';

        echo '<td>';
        if ($isAdmin) {
            echo '<select name="disabled" class="pastel-red" disabled>';
            echo '<option selected>' . ucfirst(htmlspecialchars($user['status'])) . '</option>';
            echo '</select>';
        } else {
            echo '<select name="status">';
            echo '<option value="free"' . ($user['status'] === 'free' ? ' selected' : '') . '>Free</option>';
            echo '<option value="premium"' . ($user['status'] === 'premium' ? ' selected' : '') . '>Premium</option>';
            echo '<option value="vip"' . ($user['status'] === 'vip' ? ' selected' : '') . '>VIP</option>';
            echo '<option value="blocked"' . ($user['status'] === 'blocked' ? ' selected' : '') . '>Blocked</option>';
            echo '<option value="deactivated"' . ($user['status'] === 'deactivated' ? ' selected' : '') . '>Deactivated</option>';
            echo '</select>';
        }
        echo '</td>';

        echo '<td>';
        echo '<div class="points-control">';
        if (!$isAdmin) echo '<button name="minusfidelity">−</button>';

        echo '<span class="points">' . (isset($user['points']) ? intval($user['points']) : 0) . '</span>';

        if (!$isAdmin) echo '<button name="plusfidelity">+</button>';
        echo '</div>';
        echo '</td>';

        echo '<td class="actions">';
        if (!$isAdmin) {
            echo '<button name="block" class="pastel-red">Block</button>';
            echo '<button name="deactivate" class="pastel-orange">Deactivate</button>';
        } else {
            echo '<button name="disabled" class="pastel-red admin-locked">Admin</button>';
        }
        echo '</td>';

        echo '</tr>';
    }
}
?>