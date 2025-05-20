<?php
header('Content-Type: application/json');
require '../config/db.php';
session_start();

$usuario_id = $_SESSION['usuario_id'] ?? null;
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if (!$usuario_id || !$id) {
    http_response_code(400);
    echo json_encode(['erro' => 'Requisição inválida']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM eventos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $id, $usuario_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'removido']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao excluir']);
}
