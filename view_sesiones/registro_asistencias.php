<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
    <style>
        html{
            font-size:16px;
            font-family:Arial;
            font-style: italic;
            color: white;
            font-weight: 100;
        }
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        #contenedor-general{
            width: 60%;
            background-color:  #4A0D0D ;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5%;
            border: solid gold 0.1rem;
            border-radius: 5px;
            position: relative;
        }
        #sitio{
            position: absolute;
            top: 0;
            left: 0;
            letter-spacing: 0.3 rem;
            font-size:0.9rem;
            font-weight: 100;
            color:gold;

        }
        #formulario{
            display: flex;
            flex-direction: column;
            width: 80%;
        }
        select{
            font-size: 0.8rem;
            padding: 0.2rem;
            font-style: italic;
            letter-spacing: 0.4rem;
            text-justify: center;
            text-align: center;
        }
        #submit{
            width: 80%;
            background-color: transparent; border: solid gold 0.1rem; border-radius: 3px;
            color: gold;
            font-family: Arial, Helvetica, sans-serif; font-style: italic; font-size:1vw;
            letter-spacing: 0.3rem;
            align-self: center;
            padding: 0.3rem;
        }
        #asistentes{
            font-size: 0.7rem;
            font-weight: 100;
            background-color: #F0F0F0;
            border-radius: 3px;
            border: solid gold 0.1rem;
            margin:2%;
            color:   #4A0D0D;
            overflow: auto;
        }
        .boton-sub{
        width: 98%;
        background-color: transparent;
        border: solid gold 0.1rem;
        font-size:0.8rem;
        border-radius: 3px;
        margin:1rem;
      
        padding:0.3rem;
        color:gold;
        font-family: 'Courier New', Courier, monospace;
        font-style: italic;
        margin:3px;
    }
    #boton1{
        width: 35%;
    }
    #boton2{
        width: 65%;
    }

    </style>
</head>

<body>
    <div id="contenedor-general">
        <h3 id="sitio">LTL WebSite</h3>
        <h3>Registrar Asistencia a Sesión de Entrenamiento</h3>
<!-- =================================================================================================== -->
    
        <form action="index.php?action=attendance_register" method="POST" id="formulario">
            <label for="sesion">Seleccionar sesión de entrenamiento:</label><br>
            <select name="id_sesion" id="id_sesion">
                <option value="">Elija la sesión</option>
                <?php 
                    foreach($sesiones as $sesion){
                        echo "<option  value='".htmlspecialchars($sesion['codigo'])."'>".
                        "Fecha: ".htmlspecialchars($sesion['fecha']). " /  Hora: ".htmlspecialchars($sesion['hora']).
                        "</option>";
                    }
                ?>
            </select>
        <div id="asistentes">
            <p>Seleccionar deportistas que asistieron a la sesión:</p>
            <input type="checkbox" id="select_all" /> Seleccionar todos<br><br>
                <?php 
                     foreach($deports as $depor): ?>
                        <label>
                            <input class="deportista" type="checkbox" name="id_deportista[]" value="<?= $depor['id'] ?>"> <?= $depor['nombreD'] . ' ' . $depor['apellidoD'] ?>
                        </label><br>
                    <?php endforeach; ?>
            
        </div>
            <br>
            <input type="submit" value="Registrar Asistencia" id="submit">
        </form>
<!-- =====================BOTÓN OTORGAR ESTÍMULO============================================================================= -->
        <form action="index.php?action=verOtorgarEstimulo" method="get" id="form_otorgar_estimulo">
        <input type="hidden" name="id_sesion" value="<?= htmlspecialchars($sesion['codigo'])?>">
            <button type="submit" class="boton-sub" style="margin-top: 1rem;" name="action" value="verOtorgarEstimulo">Otorgar Estímulo a Deportistas Asistentes</button>
        </form>
                        
<!-- =================================================================================================== -->
        <div style='display:flex; flex-direction: row; width:65%;margin:3%;' >
            <form action='index.php?action=principal' method='post' id="boton1">
                <button type='submit' name='action' value='principal'  class="boton-sub">Ir al inicio</button>
            </form> 
            <form action='index.php?action=trainer_manage' method='get' id="boton2">
                <button type='submit' name='action' value='trainer_manage' class="boton-sub">Sesiones de Entrenamiento</button>
            </form>
    </div>
    


    </div>
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
