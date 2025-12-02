<?php
require "conexion.php";

$pelicula_id = intval($_GET["pelicula_id"]);

$sql = "SELECT c.id, c.comentario, c.fecha, u.nombre
        FROM comentarios c
        LEFT JOIN usuarios u ON u.id = c.usuario_id
        WHERE c.pelicula_id = ?
        ORDER BY c.fecha DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pelicula_id);
$stmt->execute();

$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>