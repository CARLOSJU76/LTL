<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="JS/jquery-3.7.1.min.js"></script>
    <title>Centros de Entrenamiento</title>
</head>
<style>
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}

    body{
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        color:white;
    }
    #menu{
        display: flex;
        flex-direction: row;
        width:80%;
        justify-content: space-around;
        padding:0;
        border: solid gold 1px;
        border-radius: 3px;
        margin-top: 3%;
    }
    .form-insert{
        width: 50%;
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color: #4A0D0D;
        border: solid gold 2px;
        margin-bottom: 3%;
        padding:2%;
    }
    #uno,#dos,#tres{
        width: 33;
        margin-top: 3%;
        margin-bottom: 3%;
      
    }
    input{
        width: 80%;
       font-size: 1.3vw;
       font-style: italic;
       padding:2%;
    }
    option{
        font-size: 0.8vw;
        font-style: italic;
    }
    select{
        font-size: 1vw;
        font-style:italic;
        padding: 1%;
        width: 40%;
    }
    .form-botones{

           
            background-color: transparent; 
            border:  solid gold 1px;
            border-radius: 5px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: italic;
            font-size: 1vw;
            font-weight: bold;
            color:gold;
            width:40%;
            margin:2%;
        }
    td, th{
        padding: 1%;
        font-size:1vw;
        border:solid gold 1px;


    }
    .lugarE{
        width: 55%;
    }
    table{    
        width: 100%;
        border: solid gold 1px;
    }
    #formulario{
        margin:5%;
    }
    .lugar{
        width: 40%;
    }
    #div-botones{
        display:flex; flex-direction: row; width:80%;
        align-items: center;
        justify-content: center;
    }
    .boton-sub, p{
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
        margin: 1rem;
    }
    #boton1{
        width: 35%;
    }
    #boton2{
        width: 65%;
    }

</style>

<body>
<div class="form-insert">

    <?php if(isset($asistencias) && count($asistencias)>0):?>
        <h2>Datos de asistencia:</h2>
        <p><?= " | Lugar : ".$asistencias[0]['lugar']."<br> | Fecha: ".$asistencias[0]['fecha']." | Hora: ".$asistencias[0]['hora']."<br> | Dirigió: ".$asistencias[0]['nombreE']."  ".$asistencias[0]['apellidoE']." |   Asistentes:" ?></p>
        <table>
            <thead>
                <tr>
                    <th>Deportista</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    $user_email = $_POST['user_email'] ?? '';
                    foreach ($asistencias as $asist): ?>
                <tr>
                   
                    <td> <?=$asist['nombreD']. " " . $asist['apellidoD']?> </td>

                    <td><?=$asist['estimulo']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($asistencias)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron registros de asistencias</p>

        <?php endif;?>  
        <?php
// Verificar si el parámetro 'user_email' está presente en la URL
            $user_email = isset($_GET['user_email']) ? $_GET['user_email'] : null;
            ?>

        <?php if ($user_email): ?>
                
        <form action="index.php?action=asistenciax_sesion" method="post" style="width: 96%;" class="form-insert" id="formulario">
            <input type="hidden" name="user_email" id="user_email_input"> 
            <select name="id_sesion">            
                    <option value="">Elija un Entrenamiento </option>
                    <?php
                       
                        foreach($myAttendats as $entreno){
                            echo"<option value='".htmlspecialchars($entreno['codigo'])."'>".
                            htmlspecialchars($entreno['codigo'])." -- ".
                            htmlspecialchars($entreno['fecha'])." / ".
                            htmlspecialchars($entreno['hora']).
                            "</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Ver Asistencia" class="form-botones">
        </form>
        <?php else: ?>
        <div id="div-botones"style='display:flex; flex-direction: row; width:100%;'>
    <!-- Opcional: Puedes mostrar un mensaje si no se encuentra el 'user_email' en la URL -->
            <form action="index.php?" method="get" id="boton3">
                <input type="hidden" name="user_email" id="user_email_input"> <!-- Input oculto para el email -->
                <button id="boton_volver" type="submit" name="action" value="asistenciax_sesion" class="boton-sub">Hacer otra consulta</button>
            </form>
        <?php endif; ?>
            <div style='display:flex; flex-direction: row; width:50%;' >
                <form action='index.php?action=trainer_manage' method='get' id="boton2">
                    <button type='submit' name='action' value='trainer_manage' class="boton-sub">Sesiones de Entrenamiento</button>
                </form>
                <form action='index.php?action=principal' method='post' id="boton1">
                    <button type='submit' name='action' value='principal'  class="boton-sub">Ir al inicio</button>
                </form> 
            </div>
        </div> 

<script>
    let userEmail = localStorage.getItem('UserEmail');

// Si existe 'user_email' en localStorage, asignarlo al input oculto
if (userEmail) {
    document.getElementById('user_email_input').value = userEmail;
}

</script>
</body>
</html>