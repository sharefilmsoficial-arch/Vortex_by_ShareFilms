<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$movie_id   = trim($input['movie_id'] ?? '');
$usuario_id = trim($input['usuario_id'] ?? '');  // aquí va el ID numérico del usuario
$comentario = trim($input['text'] ?? '');

if ($movie_id === '' || $usuario_id === '' || $comentario === '') {
    echo json_encode(['success' => false, 'error' => 'movie_id, usuario_id y comentario son requeridos']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO comentarios (usuario_id, pelicula_id, comentario, fecha)
        VALUES (:usuario_id, :pelicula_id, :comentario, NOW())
    ");

    $stmt->execute([
        'usuario_id'  => $usuario_id,
        'pelicula_id' => $movie_id,
        'comentario'  => $comentario
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}