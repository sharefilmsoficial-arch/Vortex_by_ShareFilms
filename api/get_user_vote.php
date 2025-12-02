<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$movie_id = $_GET['id'] ?? '';
$user     = $_GET['user'] ?? '';

if ($movie_id === '' || $user === '') {
    echo json_encode(['vote' => 0]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT tipo 
        FROM likes
        WHERE usuario_id = :usuario_id AND pelicula_id = :pelicula_id
        LIMIT 1
    ");
    $stmt->execute([
        'usuario_id'  => $user,
        'pelicula_id' => $movie_id
    ]);

    $row = $stmt->fetch();
    $vote = 0;

    if ($row) {
        if ($row['tipo'] === 'like')     $vote = 1;
        if ($row['tipo'] === 'dislike')  $vote = -1;
    }

    echo json_encode(['vote' => $vote]);

} catch (Exception $e) {
    echo json_encode(['vote' => 0, 'error' => $e->getMessage()]);
}
