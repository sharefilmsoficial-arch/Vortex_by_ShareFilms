<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sharefilms4"; // ← Cambia por tu base

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error conectando a la BD: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>