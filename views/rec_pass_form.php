<?php
include_once 'controller/loginController.php';
    $loginController=new LoginController();
    $datos=$loginController->recover_pass_request();
        if($datos!=0){
            $correo= $datos['email'];
            $usuario= $datos['usuario'];
        
            $partes_correo = explode('@', $correo);
            $nombre_usuario = $partes_correo[0]; // Parte antes del "@"
            $correo_mostrado = substr($nombre_usuario, 0, 2) . '....@' . $partes_correo[1];
        }
        
?>
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
    
    
    <title>Recuperación de contraseña</title>
</head>
<body>
    <div class="success">

    <?php if($datos!=0):?>
        <p>El sistema te enviará un mensaje al correo: <strong><?php echo htmlspecialchars($correo_mostrado); ?></strong></p>
            <form  id="enviarRecov"  method="POST" >
                
                <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario);?>"><br>
                <input type="hidden" name="correo"  value="<?php echo htmlspecialchars($correo); ?>"><br>
                <button id="boton_LOGIN"   type="submit" name="enviarEnlace">Enviar enlace de recuperación</button>
                
            </form>
    <?php else:?>
        <p>Has incluido un usuario o correo electrónico no  válido.</p>
        <a href="index.php?action=principal">Volver a la página de inicio</a>
    <?php endif; ?>

    <?php
        if(isset($_POST['enviarEnlace'])){
            $user1=new Mailer();
            $user1->sendRecoverPassMail($correo, $usuario);
            echo" $usuario, Se ha enviado un vínculo de recuperación de contraseña a tu correo";
        }
    ?>

    </div>
    
    
    
</body>
</html>
<?php

?>