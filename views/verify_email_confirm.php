<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/stylos.css">
    <link rel="stylesheet" href="CSS/registro.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/comentarios.css">
    <title>Verificación de cuenta LTL</title>
</head>
<body>

    <h2>Liga Tolimense de Lucha</h2>
    <div class="success">
    <?php
        include_once './controller/signupController.php';
        $verify_c = new signupController();
        $datos = $verify_c->verificarCuenta();
        
        // Valores predeterminados
        $user1 = isset($datos['usuario']) ? htmlspecialchars($datos['usuario']) : '';
        $email = isset($datos['email']) ? htmlspecialchars($datos['email']) : '';
        $valor1 = '';

        if ($datos['estado'] === 1) {
            echo "Hola $user1, la cuenta $email ha sido verificada exitosamente.<br> Ahora puedes iniciar sesión.";
            $valor1 = "Ir a la página de inicio";
            session_start();
            $_SESSION['user']=$user1;
            
        } else if ($datos['estado'] === 0) {
            echo "Verificación fallida. Cuenta no registrada.";
            $valor1 = "Ir a la página principal";
        } else if ($datos['estado'] === -1) {
            echo "Token proporcionado no es válido";
            $valor1 = "Ir a la página principal";
        } else if ($datos['estado'] === -2) {
            echo "Token no proporcionado por la URL";
            $valor1 = "Ir a la página principal";
        } else {
            echo "Error: La solicitud no es de tipo GET.";
            $valor1 = "Ir a la página principal";
        }
    ?>
        <!-- Inputs ocultos para enviar los valores -->
        <form src="./views/principal.php">
            <input id="user1" type="hidden" name="usuario" value="<?php echo $user1; ?>">
            <input id="email1" type="hidden" name="email" value="<?php echo $email; ?>">
            <button id="boton_LOGIN"  type="submit" method="post"><?php echo htmlspecialchars($valor1); ?></button> 
        </form>
        

        <!-- Enlace con el texto dinámico -->
       
    </div>

    <!-- Vincular el archivo de JavaScript -->
    <script src="JS/slide.js"></script>
    <script src="JS/activo_inactivo.js"></script>
    <script src="JS/registro.js"></script>
    <script src="JS/inicio.js"></script>
    <script src="JS/bootstrap.bundle.js"></script>
    <script src="JS/comentarios.js"></script>
    <script src="JS/insertComment.js"></script>
</body>
</html>
