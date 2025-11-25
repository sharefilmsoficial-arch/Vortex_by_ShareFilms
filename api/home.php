<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit;
}
?>
<h1>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?></h1>
<p>Acceso autorizado ✔️</p>