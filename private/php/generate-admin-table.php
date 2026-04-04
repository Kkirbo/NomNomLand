<?php

function generateAdminTable($users)
{
    foreach ($users as $u) {
        $isAdmin = $u['role'] === 'admin';

        echo '<tr>';

        echo '<td><span>' . htmlspecialchars($u['id']) . '</span></td>';
        echo '<td><span>' . htmlspecialchars($u['profile']['lastName']) . ' ' . htmlspecialchars($u['profile']['firstName']) . '</span></td>';
        echo '<td><span>' . htmlspecialchars($u['profile']['username']) . '</span></td>';
        echo '<td><span>' . htmlspecialchars($u['email']) . '</span></td>';

        // ROLE
        echo '<td>';
        if ($isAdmin) {
            echo '<select class="pastel-red" disabled>';
            echo '<option selected>Admin</option>';
            echo '</select>';
        } else {
            echo '<select>';
            echo '<option value="client"' . ($u['role'] === 'client' ? ' selected' : '') . '>Client</option>';
            echo '<option value="delivery"' . ($u['role'] === 'delivery' ? ' selected' : '') . '>Delivery</option>';
            echo '<option value="cook"' . ($u['role'] === 'cook' ? ' selected' : '') . '>Cook</option>';
            echo '</select>';
        }
        echo '</td>';

        // STATUS
        echo '<td>';
        if ($isAdmin) {
            echo '<select class="pastel-red" disabled>';
            echo '<option selected>' . ucfirst(htmlspecialchars($u['status'])) . '</option>';
            echo '</select>';
        } else {
            echo '<select>';
            echo '<option value="free"' . ($u['status'] === 'free' ? ' selected' : '') . '>Free</option>';
            echo '<option value="premium"' . ($u['status'] === 'premium' ? ' selected' : '') . '>Premium</option>';
            echo '<option value="vip"' . ($u['status'] === 'vip' ? ' selected' : '') . '>VIP</option>';
            echo '<option value="blocked"' . ($u['status'] === 'blocked' ? ' selected' : '') . '>Blocked</option>';
            echo '<option value="deactivated"' . ($u['status'] === 'deactivated' ? ' selected' : '') . '>Deactivated</option>';
            echo '</select>';
        }
        echo '</td>';

        // POINTS
        echo '<td>';
        echo '<div class="points-control">';
        if (!$isAdmin) echo '<button id="minusfidelity">−</button>';

        echo '<span class="points">' . (isset($u['points']) ? intval($u['points']) : 0) . '</span>';

        if (!$isAdmin) echo '<button id="plusfidelity">+</button>';
        echo '</div>';
        echo '</td>';

        // ACTIONS
        echo '<td class="actions">';
        if (!$isAdmin) {
            echo '<button class="pastel-red">Block</button>';
            echo '<button class="pastel-orange">Deactivate</button>';
        } else {
            echo '<button class="pastel-red admin-locked">Admin</button>';
        }
        echo '</td>';

        echo '</tr>';
    }
}