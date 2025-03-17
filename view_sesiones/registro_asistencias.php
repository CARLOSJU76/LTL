<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
</head>
<body>
    <h1>Registrar Asistencia a Sesión de Entrenamiento</h1>
    
    <form action="index.php?action=attendance_register" method="POST">
        <label for="sesion">Seleccionar sesión de entrenamiento:</label><br>
        <select name="id_sesion" id="id_sesion">
            <option value="">Elija la sesión</option>
            <?php 
                foreach($sesiones as $sesion){
                    echo "<option  value='".htmlspecialchars($sesion['codigo'])."'>".
                    "Fecha:".htmlspecialchars($sesion['fecha']). " / Hora:".htmlspecialchars($sesion['hora']).
                    "</option>";
                }
            ?>
        </select>
        <div id="asistentes">
            <p>Seleccionar deportistas que asistieron a la sesión:</p>
            <input type="checkbox" id="select_all" /> Seleccionar todos<br><br>
            <?php 
                foreach($deports as $depor){
                    echo "<input class='deportista' type='checkbox' name='id_deportista[]' value='" . $depor['id'] . "'> "  . $depor['nombreD']." ". $depor['apellidoD'] ."<br>";
                }
            ?>

        </div>
       
        <br><br>
        <input type="submit" value="Registrar Asistencia">
    </form>
    <script>
    // Script para seleccionar/deseleccionar todos los checkboxes
    document.getElementById('select_all').addEventListener('change', function() {
        // Obtiene todos los checkboxes de deportistas
        const checkboxes = document.querySelectorAll('.deportista');
        
        // Cambia el estado de todos los checkboxes según el checkbox "Seleccionar todos"
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select_all').checked;
        });
    });
</script>
</body>
</html>
