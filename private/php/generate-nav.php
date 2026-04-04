<?php
function computePages($array, $maxPerPage) {
    return max(1, ceil(count($array) / $maxPerPage));
}

function normalizePage($page, $pagesCount) {
    $page = (int)$page;
    return (int)min(max(1, $page), $pagesCount);
}

function sliceArrayToPage($array, $maxPerPage, $page, $pagesCount=0) {
    if ($pagesCount <= 0) $pagesCount = computePages($array, $maxPerPage);
    $page = normalizePage($page, $pagesCount);
    $offset = ($page - 1) * $maxPerPage;
    return array_slice($array, $offset, $maxPerPage);
}

function generateNavbar($page, $pagesCount)
{
    $page = normalizePage($page, $pagesCount);
    echo '<nav class="pageNav">';
    if ($page > 1) {
        echo '
            <a href="?page=' . ($page - 1) . '">← Prev</a>
        ';
    }
    $start = max(1, $page - 2);
    $end = min($pagesCount, $page + 2);
    for ($i = $start; $i <= $end; $i++) {
        $class = ($i == $page) ? ' class="current"' : '';
        echo '
            <a href="?page=' . ($i) . '"' . $class . '>' . $i . '</a>
        ';
    }
    if ($page < $pagesCount) {
        echo '
            <a href="?page=' . ($page + 1) . '">Next →</a>
        ';
    }
    echo '</nav>';
}
?>