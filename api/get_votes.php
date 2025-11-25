<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$movie_id = $_GET['id'] ?? '';

if ($movie_id === '') {
    echo json_encode(['likes' => 0, 'dislikes' => 0]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT 
            SUM(tipo = 'like') AS likes,
            SUM(tipo = 'dislike') AS dislikes
        FROM likes
        WHERE pelicula_id = :pelicula_id
    ");
    $stmt->execute(['pelicula_id' => $movie_id]);
    $data = $stmt->fetch();

    echo json_encode([
        'likes'    => intval($data['likes'] ?? 0),
        'dislikes' => intval($data['dislikes'] ?? 0)
    ]);

} catch (Exception $e) {
    echo json_encode(['likes' => 0, 'dislikes' => 0, 'error' => $e->getMessage()]);
}
