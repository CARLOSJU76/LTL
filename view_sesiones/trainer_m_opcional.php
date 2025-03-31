<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Sesiones de Entrenamiento</title>
    <style>
        html{
            font-size:30 px;
        }
        body{
            width: 100%;
            height: 100%;
            display:flex;
            flex-direction: column;
            align-items: center;
           
        }
        #menuForm{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content:center;
            background-color: transparent;
        /* background-color:  #4A0D0D; */
            width: 60%;
            aspect-ratio: 2/1;
        }
        #lista_principal, .submenu{
            display:flex;
            flex-direction: row;
            justify-content: center;
            width: 25rem;
            border-radius: 3px;
            border: solid gold 0.1rem;
        }
        #principal{
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 80%;
        }
        .menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #f1f1f1;
            width: 25rem;
            font-family: Arial, sans-serif;
            border-radius: 3px;
        
        }

        .menu > li {
            position: relative;
        }

        .menu a {
            width: 15rem;
            display: block;
            padding: 0.3rem;
            text-decoration: none;
            color: #4A0D0D;
            background-color: #f1f1f1;
            border-radius: 3px;
            font-size: 0.8rem;
            letter-spacing: 0.3rem;
            font-style: italic;
        }

        .menu a:hover {
            background-color: #ddd;
        }

        /* Estilos para el submenú */
        .submenu, .submenu1{
            display: none;
            width: 15rem;
            position: absolute;
            top: 0;
            left: 100%; /* Coloca el submenú a la derecha */
            background-color: #f9f9f9;
            list-style-type: none;
            padding: 0;
            margin: 0;
            min-width: 200px; /* Asegura que el submenú tenga un ancho mínimo */
            z-index: 1; /* Hace que el submenú esté por encima de otros elementos */
            border: solid gold 1px;
          
        }

        .submenu li a {
            padding: 10px;
            background-color: #f9f9f9;
            width: 20rem;
            font-size: 0.6rem;
        }

        .submenu li a:hover {
            background-color: #ddd;
        }

        /* Mostrar el submenú cuando el usuario pasa el mouse */
        .menu > li:hover > .submenu {
            display: block;
        }
        .submenu > li:hover >.submenu1{
            display:block;
        }
    #cont_general{
        background-color:#4A0D0D;
         width:60%;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         align-items: center;
    }
    #form-bot{
        width: 40%;
    }
    #boton-sub{
        width: 100%;
        background-color: transparent;
        border: solid gold 0.1rem;
        font-size:0.8rem;
        border-radius: 3px;
        margin-bottom: 5%;
        padding:0.3rem;
        color:gold;
        font-family: 'Courier New', Courier, monospace;
        font-style: italic;
        letter-spacing: 0.3rem;
    }
        
    </style>
</head>
<body>

<!-- Menú con submenú -->
<div id="cont_general">
<h2 style="font-style:italic; font-family:Arial; color:white; letter-spacing:0.4rem;">LTL WebSite</h2>
<form action="index.php?" method="get" id="menuForm">
    
<input type="hidden" name="action" id="actionInput">
<input type="hidden" name="user_email" id="user_email">
<h2 style="font-style:italic; font-family:Arial; color:white; font-size: 1rem; font-weight: 100; letter-spacing:0.3rem;">Administrador Sesiones de Entrenamiento</h2>
<ul class="menu" id="lista_principal">
    <li id="principal" style="width: 25rem; padding:0.3rem;">
        <a href="#" style="color: #4A0D0D; font-weight:100; width: 20rem; ">Sesiones de Entrenamiento</a>
        <ul class="submenu">
            <li><a href="#"  data-value="schedule_session">Programar Sesiones</a></li>
            <li>
                <a href="#">Ver Sesiones programadas</a>
                <ul class="submenu1">
                <li><a href="#" data-value=""> </a></li>
                    <li><a href="#" data-value="list_your_sessions">Mis Sesiones programadas</a></li>
                    <li><a href="#" data-value="list_sessionByFecha">Buscar sesión programada por fecha</a></li>
                    <li><a href="#" data-value="list_sessionBySite">Programadas x lugar de entrenamiento</a></li>                    
                </ul>
            </li>
            <li><a href="#">Histórico de entrenamientos</a>
            <ul class="submenu1">
                   
                   <li><a href="#" data-value=""> </a></li>
                   <li><a href="#" data-value=""> </a></li>
                  
                   <li><a href="#" data-value="list_workout_byFecha">Mis Sesiones Dirigidas x Fecha</a></li>
                  
                   <!-- <li><a href="#" data-value="list_sessionByFecha">Buscar sesión programada por fecha</a></li> -->
                   <!-- <li><a href="#">Buscar sesión por lugar de entrenamiento</a></li> -->
               </ul>
            </li>
            <li>
                <a href="#">Asistencias</a>
                <ul class="submenu1">
                    <li><a href="#" data-value=""> </a></li>
                    <li><a href="#" data-value=""> </a></li>
                    <li><a href="#" data-value=""> </a></li>
                    <li><a href="#" data-value="asistenciax_sesion">Listar Asistencias por Sesion</a></li>
                    <li><a href="#" data-value="attendance_register">Tomar Asistencia</a></li>
                    <!-- <li><a href="#" data-value="list_sessionByFecha">Buscar sesión programada por fecha</a></li> -->
                    <!-- <li><a href="#">Buscar sesión por lugar de entrenamiento</a></li> -->
                </ul>
            </li>
        </ul>
    </li>
</ul>

</form>
<form action='index.php?action=principal' method='post' enctype='multipart/form-data' id="form-bot">
    <button type='submit' name='action' value='principal' id="boton-sub">Ir al inicio</button>
</form> 
</div>


<script>
//=================================================================================================


document.querySelectorAll('.menu a, .submenu a, .submenu1 a').forEach(item => {
    item.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar que el enlace navegue por defecto
        let email_usuario=localStorage.getItem('UserEmail');
        
        //alert("user email="+ email_usuario);
        const selectedValue = this.getAttribute('data-value'); // Capturar el valor seleccionado
        if (selectedValue) {
           
            document.getElementById('actionInput').value = selectedValue;
            document.getElementById('user_email').value= email_usuario;
            document.getElementById('menuForm').submit(); // Enviar el formulario
        }
    });
});

</script>

</body>
</html>
