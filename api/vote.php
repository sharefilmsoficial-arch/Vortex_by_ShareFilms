<?php
session_start();
require "conexion.php";

$usuario_id  = $_SESSION["usuario_id"];
$pelicula_id = intval($_POST["pelicula_id"]);
$tipo        = $_POST["tipo"]; // 'like' o 'dislike'

// Primero eliminar reacción previa
$conn->query("DELETE FROM likes_dislikes 
              WHERE usuario_id = $usuario_id 
              AND pelicula_id = $pelicula_id");

// Insertar nueva
$sql = "INSERT INTO likes_dislikes (usuario_id, pelicula_id, tipo)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $usuario_id, $pelicula_id, $tipo);

echo $stmt->execute() ? "OK" : "ERROR";
?>