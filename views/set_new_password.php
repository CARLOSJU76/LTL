
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
    <title>Recuperación de Contraseña</title>
    <?php
 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
     // Obtener los parámetros de la URL
    $correo = isset($_GET['email']) ? $_GET['email'] : '';
    $usuario = isset($_GET['user']) ? $_GET['user'] : '';
?>
    <div class="success">
        <form action="index.php?action=set_new_pass" method="POST">
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>"><br>
            <input type="password" name="clave" placeholder="Digita una nueva contraseña" required><br>
            <input type="password" name="confirm" placeholder="Confirma tu contraseña" required><br>
            <button id="boton_LOGIN" type="submit" name="enviarEnlace">Actualizar contraseña</button>
        </form>
    </div>
<?php
    }
?>


    

   

</head>
<body>
    
</body>
</html>
