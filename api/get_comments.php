<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$movie_id = $_GET['id'] ?? '';

try {
    if ($movie_id === '') {
        $stmt = $pdo->query("SELECT * FROM comentarios ORDER BY fecha DESC LIMIT 50");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM comentarios WHERE pelicula_id = :pelicula_id ORDER BY fecha DESC");
        $stmt->execute(['pelicula_id' => $movie_id]);
    }

    echo json_encode($stmt->fetchAll());

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}