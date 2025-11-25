<?php
session_start();
require 'api/conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre   = trim($_POST["nombre"]);
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Verificar email duplicado
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $mensaje = "❌ El correo ya está registrado";
    } else {
        // Encriptar contraseña
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar usuario
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, fecha_registro)
                               VALUES (?, ?, ?, NOW())");

        if ($stmt->execute([$nombre, $email, $passwordHash])) {

            // Iniciar sesión automáticamente
            $_SESSION["usuario_id"] = $pdo->lastInsertId();
            $_SESSION["usuario_nombre"] = $nombre;

            header("Location: index.html");
            exit;
        } else {
            $mensaje = "❌ Error al registrar usuario";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear cuenta - ShareFilms4</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="modal" style="display:flex;">
    <div class="modal-content">

        <h2>Crear cuenta</h2>

        <?php if ($mensaje): ?>
        <p style="color:#ff4444; font-weight:bold;"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nombre" placeholder="Tu nombre" required>

            <input type="email" name="email" placeholder="Correo electrónico" required>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <button class="btn-enviar" type="submit">Registrarme</button>
        </form>

        <button class="btn-cerrar" onclick="window.location='index.html'">Volver</button>

        <p style="margin-top:10px;">
            ¿Ya tienes cuenta?
            <a href="login.php" style="color:#00aaff;">Iniciar sesión</a>
        </p>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";
    } else {
        input.type = "password";
        icon.textContent = "👁️";
    }
}
</script>

</body>
</html>