<?php
session_start();
require "conexion.php";

$email = $_POST["email"];
$pass  = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if (password_verify($pass, $user["password"])) {
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario_nombre"] = $user["nombre"];
        echo "OK";
        exit;
    }
}

echo "ERROR";
?>