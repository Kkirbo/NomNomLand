<?php
$id = $_GET['id'] ?? '';
$type = $_GET['type'] ?? '';

require '../../private/php/get-modal-info.php';
$modalInfo = getModalInfo($type, $id);
if ($modalInfo) {
    echo json_encode($modalInfo);
    exit;
}
http_response_code(404);
echo json_encode(['error' => 'Item not found']);
?>