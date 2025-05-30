<?php
session_start();
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
    <link rel="stylesheet" href="CSS/mediaQ.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous"> -->

    <title> TOLIMA'S WRESTLING LEAGUE  </title>
  
    <!-- body{
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        } -->

    <!-- <style>
        html{
            font-size:2vw;
        }
    </style> -->
</head>
<body>


<div id="contenedor-general">
    
    <!-- En este punto comienza la barra creada con bootstrap -->
    <!-- ======================================================================================= -->

    <div class="container" id="container"> 
    <!--Imagen de Icono Inicial  -->
    <!-- ======================================================================================= -->
        <div id="div-x">
            <img src="IMG/icono-de-favoritos.png" id="imagen-x">
            <label id="etiqueta">
                <input type="checkbox" id="toggleButton">
                <div class="toggle">
                    <span class="top_line common"></span>
                    <span class="middle_line common"></span>
                    <span class="bottom_line common"></span>
                </div>
            </label>
        </div>
    <!-- Imagen de Icono responsivo para pantallas menores -->
    <!-- ======================================================================================= -->
        <div class="row" id="toggleElement">
            <div class="col-sm-6 col-md-4 col-lg-2"  id="filas1">
                <img src="IMG/icono-de-favoritos.png" id="img-icon">
            </div>
    <!-- Botones de la barra -->
    <!--======================================================================================== -->
            <div class="col-sm-6 col-md-4 col-lg-2"  id="filas">
                <a href="#" id="anchor-boton"><button id="boton-barra" >Inicio</button></a>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-2" id="filas">
                <a href="index.php?action=listar_eventos" id="anchor-boton"><button id="boton-barra" >Calendarios</button></a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2" id="filas">
            <form action="index.php" method="GET" id="Plataforma">
                        <select name="action" id="select-plataforma" class="opciones_activas" onchange="this.form.submit()">
                        <option value="" disabled selected>Opciones de Plataforma</option>
                        <option   value="ver_mision">Nuestra Misión</option>
                            <option value="ver_vision">Visión </option>
                            <option value="ver_estados">Estados financieros</option>
                        </select>
                    </form>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2"  id="filas">
                <a href="index.php?action=lista_ranking" id="anchor-boton"><button id="boton-barra">Ranking Local</button></a>
            </div>
            <!--Botones signup y login  /  Elegir opciones-->
<!-- =============================================================================================== -->

            <div class="col-sm-6 col-md-4 col-lg-2"  id="filas">
                <div id="signup">
                    <!-- perfil inicio -->
                    <form  id="perfil-inicio" class="opciones_activas"> <!--id: necesario, class: necesario  -->
                        <select  id="select-inicio" class="opciones_activas" > <!-- class: necesario -->
                            <option value="3" disabled selected>Inicio/Registro</option>
                            <option value="1">Registrate</option>
                            <option value="2">Inicia Sesión</option>
                        </select>
                    </form>
                    <form id="perfil-administrador"  class="opciones_inactivas">
                        <select name="action" id="select-admin" class="opciones_activas">
                            <!-- <option value="" disabled selected>Opciones de Administrador</option>
                            <option class="option"  value="club_manage">Gestión de clubes</option>
                            <option value="sport_manage">Deportistas y Entrenadores</option>
                            <option value="trainer_manage">Sesiones de entrenamiento</option>
                            <option value="event_manage">Competencias-calendarios</option>
                            <option value="my_performance">My performances</option>
                            <option value="elements_manage">Gestor de elementos</option>
                            <option value="logout">Salir</option> -->
                        </select>
                    </form>
<!-- ==============================================SELECT DE PERFIL================================================================================== -->
                </div>
            </div>
        </div>
    </div>
    <!-- =============================ROTULO DE LA LIGA============================================================= -->
    <div class="dorado"></div>


    <label id="liga">LIGA TOLIMENSE DE LUCHA OLIMPICA 
        <span>
            <?php  
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                }
            ?>
        </span>
    </label>
<!-- ============================================================================================= -->
<!-- ============================================================================================= -->
<?php

// Captura y limpia el mensaje flash desde la sesión
$msg = '';
$tipo = '';

if (isset($_SESSION['msg1'], $_SESSION['tipo1'])) {
    $msg = $_SESSION['msg1'];
    $tipo = $_SESSION['tipo1'];
    unset($_SESSION['msg1'], $_SESSION['tipo1']);
} elseif (isset($_SESSION['msg'], $_SESSION['tipo'])) {
    $msg = $_SESSION['msg'];
    $tipo = $_SESSION['tipo'];
    unset($_SESSION['msg'], $_SESSION['tipo']);
}
?>

<?php if (!empty($msg)): ?>
    <!-- Estilos opcionales para el efecto de desvanecimiento -->
    <style>
        .mensajeFlash {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .mensajeFlash.fade-out {
            opacity: 0;
        }
    </style>

    <!-- Mensaje Flash HTML -->
    <div id="mensajeFlash" class="mensajeFlash"
         style="background-color: <?= $tipo === 'success' ? '#d4edda' : ($tipo === 'error' ? '#f8d7da' : '#ccc') ?>;">
        <?= htmlspecialchars($msg) ?>
    </div>

    <!-- Script para ocultar el mensaje con efecto -->
    <script>
        setTimeout(() => {
            const mensaje = document.getElementById('mensajeFlash');
            if (mensaje) {
                mensaje.classList.add('fade-out');
                // Elimina del DOM tras la transición
                setTimeout(() => mensaje.remove(), 500); // 0.5s coincide con la transición CSS
            }
        }, 5000); // Espera 5 segundos antes de desvanecer
    </script>
<?php endif; ?>
<!-- ============================================================================================= -->
<!-- ============================================================================================= -->

    
    <div class="dorado"></div>
    

    <!-- Sección de slider -->
     <!-- ========================================================================================= -->
    <div class="slider">
        <div class="slide">
            <img src="./IMG/LTL/mat.jpg" alt="imagen1" id="imagen-img">
            <button class="prev"onclick="prevSlide()">&#10094</button>
            <button class="next"onclick="nextSlide()">&#10095</button>
        </div>
        <div class="slide">
            <img src="IMG/LTL/dark-mat.jpg" alt="imagen2" id="imagen-img">
            <button class="prev"onclick="prevSlide()">&#10094</button>
            <button class="next"onclick="nextSlide()">&#10095</button>
        </div>
        <div class="slide">
            <img src="IMG//LTL/renteria.jpg" alt="imagen3" id="imagen-img">
            <button class="prev"onclick="prevSlide()">&#10094</button>
            <button class="next"onclick="nextSlide()">&#10095</button>
        </div>
        <div class="slide">
            <img src="IMG//LTL/luchafemenil.jpg" alt="imagen3" id="imagen-img">
            <button class="prev"onclick="prevSlide()">&#10094</button>
            <button class="next"onclick="nextSlide()">&#10095</button>
        </div>
    </div>
</div>

<!-- FORMULARIO LOGIN -->
 <!-- ====================================================================================================================== -->
<div id="contenedor_LOGIN" class="opciones_inactivas">

    <form id="formulario_LOGIN" action="index.php?action=loguear" method="post">

            <div id="div_cerrar_LOGIN" class="elementos_LOGIN"><div  id="cerrar_LOGIN">X</div></div>

            <h2 id="titulo_LOGIN" >Inicio de Sesión</h2>

            <input type="text" id="usuario"class="elementos_LOGIN"  name= "usuario" required placeholder="Nombre de usuario">
            <label for="usuario" id="label_usuario" class="elementos_LOGIN">Digita tu usuario o  Email</label>

            <input type="password" class="elementos_LOGIN" id="passw" name="passw"required placeholder="Digita tu contraseña">
            <label for="passw"class="elementos_LOGIN" id="label_passw" >Ingresa tu contraseña!!</label>

            <input type="submit" id="boton_LOGIN" class="elementos_LOGIN" value="Iniciar Sesión">
            <!-- Para seguir mejorando: "olvidaste tu contraseña??" -->
            
            <a href="#" class="elementos_LOGIN"id="olvidaste" style="text-align: center; ">Olvidaste tu contraseña?</a>
    </form>   

</div>
<div id="mensaje_LOGIN" class="" ></div>
<input type="hidden" id="perfil_de_usuario" >
<!-- FORMULARIO SIGN UP  -->
 <!--========================================================================================================================= -->
 <div id="div_contenedor_SIGNUP" class="opciones_inactivas" >


    <form id="formulario_SIGNUP" action="index.php?action=registro" method="POST" >
        <div id="cerrar_SIGNUP" >X</div>

        <h2 id="titulo_SIGNUP">Formularios de Registro</h2>

        <input type="text" id="username" name= "username" required placeholder="Nombre de usuario">
         <label for="username" class="username">Digita un nombre de usuario</label>


        <input type="email" id="email" name="email" required placeholder="Email">
        <label for="email" class="email">Escribe tu dirección E-mail</label>


        <input type="password" id="password" name="password"required placeholder="Digita una contraseña">
        <label for="password" class="password" >Ingresa 6 o más caracteres!!</label>


        <input type="password" id="confirmacion" name="confirmacion" required  placeholder="Confirma tu contraseña">
        <label for="confirmacion" class="confirmacion">Debes digitar el mismo valor del campo anterior</label>

        <input type="submit"  id="boton_SIGNUP" value="Registrate">       

    </form>
    
</div>

<div id="mensaje_SIGNUP" class=""></div>
<div id="saludoInicial" class=""></div>
<div id="usuarioActual"></div>

<div id="mensaje_verifyAccount"></div>

<!--SECCION DE LOS COMENTARIOS: =================================================================================================================== -->
<!--Inserción de comentarios: --------------------------------------------->
<div id="contenedor_comentarios" class="opciones_inactivas">
    <div id="encab_comentarios" class="caja">Comentarios de los Usuarios</div>
    <div id="comments" class="caja" readonly></div>
    <div id="mensaje_COMMENT" class=""></div>
<!--Formulario para registrar comentarios:----------------------------------------------------------------------------------------------------------------------------------------------- -->
   
    <form id="RegistroComentarios"  class="caja">
        <input type="text" id="autor" name="autor" class="caja" value="">
        <textarea id="comentario1" name="comentario" class="caja" placeholder="Escribe tu comentario" required></textarea>
        <button id="comentario2" type="submit" class="caja"  >Comparte un comentario</button>
    </form>
  </div>
  <button class= "boton-circulo"  id="enable-comments" onclick="enable_comments()"><div id="resaltado">Comentarios</div></button>
  <button class= "opciones_inactivas"  id="disable-comments" onclick="disable_comments()"><div id="resaltado">Ocultar</div></button>

<!-- ============================================================================================================================================== -->
    <script src="JS/darlike.js"></script>
    <script src="JS/logout.js"></script>
    <script src="JS/slide.js"></script>
    <script src="JS/activo_inactivo.js"></script>
    <script src="JS/registro.js"></script>
    <script src="JS/inicio.js"></script>
    <script src="JS/bootstrap.bundle.js"></script>
    <script src="JS/cargarComentarios.js"></script>
    <!-- <script src="JS/comentarios.js"></script> -->
    <script src="JS/insertComment.js"></script>
</body>
</html>



