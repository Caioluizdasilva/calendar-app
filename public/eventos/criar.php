<?php
header('Content-Type: application/json');
require '../config/db.php';
session_start();

$usuario_id = $_SESSION['usuario_id'] ?? null;
$data = json_decode(file_get_contents('php://input'), true);

$title = $data['title'] ?? '';
$start = $data['start'] ?? '';
$end = $data['end'] ?? '';

if (!$usuario_id || !$title || !$start) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados incompletos']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO eventos (title, start, end, usuario_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $title, $start, $end, $usuario_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao salvar']);
}
