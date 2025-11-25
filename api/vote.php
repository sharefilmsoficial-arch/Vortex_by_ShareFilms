<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/conexion.php';

$input = json_decode(file_get_contents('php://input'), true);

$movie_id = $input['movie_id'] ?? '';
$user     = $input['user'] ?? '';
$vote     = $input['vote'] ?? null;

if ($movie_id === '' || $user === '' || !in_array($vote, [-1, 0, 1], true)) {
    echo json_encode(['success' => false, 'error' => 'movie_id, user and vote required']);
    exit;
}

try {
    // Verificar si existe
    $stmt = $pdo->prepare("
        SELECT id FROM likes 
        WHERE usuario_id = :usuario AND pelicula_id = :pelicula
        LIMIT 1
    ");
    $stmt->execute(['usuario' => $user, 'pelicula' => $movie_id]);
    $exists = $stmt->fetch();

    if ($exists) {
        if ($vote === 0) {
            // Borrar voto
            $stmt = $pdo->prepare("DELETE FROM likes WHERE id = :id");
            $stmt->execute(['id' => $exists['id']]);
        } else {
            // Actualizar voto
            $tipo = $vote === 1 ? 'like' : 'dislike';
            $stmt = $pdo->prepare("UPDATE likes SET tipo = :tipo WHERE id = :id");
            $stmt->execute(['tipo' => $tipo, 'id' => $exists['id']]);
        }
    } else {
        if ($vote !== 0) {
            // Insertar nuevo voto
            $tipo = $vote === 1 ? 'like' : 'dislike';
            $stmt = $pdo->prepare("
                INSERT INTO likes (pelicula_id, usuario_id, tipo)
                VALUES (:pelicula, :usuario, :tipo)
            ");
            $stmt->execute([
                'pelicula' => $movie_id,
                'usuario'  => $user,
                'tipo'     => $tipo
            ]);
        }
    }

    // Obtener totales
    $stmt = $pdo->prepare("
        SELECT 
            SUM(tipo='like') AS likes,
            SUM(tipo='dislike') AS dislikes
        FROM likes
        WHERE pelicula_id = :pelicula
    ");
    $stmt->execute(['pelicula' => $movie_id]);
    $data = $stmt->fetch();

    echo json_encode([
        'success'  => true,
        'likes'    => intval($data['likes'] ?? 0),
        'dislikes' => intval($data['dislikes'] ?? 0)
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
