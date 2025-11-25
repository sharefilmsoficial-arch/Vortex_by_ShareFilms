<?php
session_start();
require 'api/conexion.php'; // conexión a tu BD

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Buscar usuario
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Validar contraseña encriptada
        if (password_verify($password, $usuario["password"])) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];

            header("Location: index.html");
            exit;
        } else {
            $mensaje = "❌ Contraseña incorrecta";
        }
    } else {
        $mensaje = "❌ El usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar sesión - ShareFilms4</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="modal" style="display:flex;">
    <div class="modal-content">

        <h2>Iniciar sesión</h2>

        <?php if ($mensaje): ?>
        <p style="color:#ff5555; font-weight:bold;"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Correo electrónico" required>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <button class="btn-enviar" type="submit">Entrar</button>
        </form>

        <button class="btn-cerrar" onclick="window.location='index.html'">Volver</button>

        <p style="margin-top:10px;">
            ¿No tienes cuenta?
            <a href="register.php" style="color:#00aaff;">Crear cuenta</a>
        </p>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";  // ojo cerrado
    } else {
        input.type = "password";
        icon.textContent = "👁️";  // ojo abierto
    }
}
</script>

</body>
</html>