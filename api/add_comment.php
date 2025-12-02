<?php
session_start();
require "conexion.php";

$usuario_id  = $_SESSION["usuario_id"];
$pelicula_id = intval($_POST["pelicula_id"]);
$comentario  = $_POST["comentario"];

$sql = "INSERT INTO comentarios (usuario_id, pelicula_id, comentario)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $usuario_id, $pelicula_id, $comentario);

echo $stmt->execute() ? "OK" : "ERROR";
?>