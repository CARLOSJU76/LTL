<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú con Submenú</title>
    <style>
        /* Estilos básicos para el menú */
        .menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #f1f1f1;
            width: 200px;
            font-family: Arial, sans-serif;
        }

        .menu > li {
            position: relative;
        }

        .menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            background-color: #f1f1f1;
        }

        .menu a:hover {
            background-color: #ddd;
        }

        /* Estilos para el submenú */
        .submenu, .submenu1{
            display: none;
            position: absolute;
            top: 0;
            left: 100%; /* Coloca el submenú a la derecha */
            background-color: #f9f9f9;
            list-style-type: none;
            padding: 0;
            margin: 0;
            min-width: 200px; /* Asegura que el submenú tenga un ancho mínimo */
            z-index: 1; /* Hace que el submenú esté por encima de otros elementos */
        }

        .submenu li a {
            padding: 10px;
            background-color: #f9f9f9;
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
        
    </style>
</head>
<body>

<!-- Menú con submenú -->
<form action="index.php?" method="get" id="menuForm">
<input type="hidden" name="action" id="actionInput">
<ul class="menu">
    <li>
        <a href="#">Sesiones de Entrenamiento</a>
        <ul class="submenu">
            <li><a href="#"  data-value="schedule_session">Programar Sesiones</a></li>
            <li>
                <a href="#">Ver Sesiones programadas</a>
                <ul class="submenu1">
                    <li><a href="#" data-value="list_sessionById">Buscar sesión por entrenador</a></li>
                    <li><a href="#" data-value="list_sessionByFecha">Buscar sesión por fecha</a></li>
                    <li><a href="#">Buscar sesión por lugar de entrenamiento</a></li>
                </ul>
            </li>
            <li><a href="#">Histórico de sesiones</a></li>
            <li><a href="#">Asistencias</a></li>
        </ul>
    </li>
</ul>

</form>


<script>
    // Manejo de eventos para capturar el valor 'data-value'
    document.querySelectorAll('.menu a').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el enlace navegue por defecto
            const selectedValue = this.getAttribute('data-value');
            console.log('Opción seleccionada:', selectedValue);

            // Aquí puedes hacer lo que necesites con el valor seleccionado
            // Por ejemplo, podrías enviar el valor con un formulario, cambiar el contenido de la página, etc.

            // Si estás usando un formulario, podrías hacer algo como:
            // document.getElementById('inputHidden').value = selectedValue;
            // document.getElementById('myForm').submit();
        });
    });
//=================================================================================================
// document.querySelectorAll('.menu a').forEach(item => {
//         item.addEventListener('click', function(event) {
//             event.preventDefault(); // Evitar que el enlace navegue por defecto
            
//             const selectedValue = this.getAttribute('data-value'); // Capturar el valor seleccionado
//             if (selectedValue) {
//                 document.getElementById('actionInput').value = selectedValue; // Asignar el valor al campo oculto
//                 document.getElementById('menuForm').submit(); // Enviar el formulario
//             }
//         });
//     });

document.querySelectorAll('.menu a, .submenu a, .submenu1 a').forEach(item => {
    item.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar que el enlace navegue por defecto
        
        const selectedValue = this.getAttribute('data-value'); // Capturar el valor seleccionado
        if (selectedValue) {
            document.getElementById('actionInput').value = selectedValue; // Asignar el valor al campo oculto
            document.getElementById('menuForm').submit(); // Enviar el formulario
        }
    });
});

</script>

</body>
</html>
