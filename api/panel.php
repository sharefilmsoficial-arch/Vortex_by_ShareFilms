<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
    exit;
}
?>

<h1>Bienvenido <?= $_SESSION["usuario"] ?> 🎬</h1>
<p>Has ingresado correctamente al panel privado.</p>
<a href="logout.php">Cerrar sesión</a>