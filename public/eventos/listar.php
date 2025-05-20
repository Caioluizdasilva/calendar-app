<?php
header('Content-Type: application/json');
require '../config/db.php';
session_start();

$usuario_id = $_SESSION['usuario_id'] ?? null;

if (!$usuario_id) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT id, title, start, end FROM eventos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}

echo json_encode($eventos);
