<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$input = json_decode(file_get_contents('php://input'), true);
$movie_id = $input['movie_id'] ?? '';

if ($movie_id === '') {
    echo json_encode(['success' => false, 'error' => 'movie_id required']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM comentarios WHERE pelicula_id = :pelicula_id");
    $stmt->execute(['pelicula_id' => $movie_id]);

    echo json_encode(['success' => true, 'deleted' => $stmt->rowCount()]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}