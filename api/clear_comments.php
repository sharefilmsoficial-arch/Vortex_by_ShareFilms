<?php
require "conexion.php";

$pelicula_id = intval($_POST["pelicula_id"]);

$sql = "DELETE FROM comentarios WHERE pelicula_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pelicula_id);

echo $stmt->execute() ? "OK" : "ERROR";
?>