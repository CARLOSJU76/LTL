<div id="fondo-asistencia">
    <?php if(isset($asistencias) && count($asistencias)>0):?>
        <h2>Datos de asistencia:</h2>
        <p id="encabezado"><?= " | Lugar : ".$asistencias[0]['lugar']."<br> | Fecha: ".$asistencias[0]['fecha']." | Hora: ".$asistencias[0]['hora']."<br> | Dirigió: ".$asistencias[0]['nombreE']."  ".$asistencias[0]['apellidoE']." |   Asistentes:" ?></p>
        <table id="tabla-asistencia">
            <thead>
                <tr>
                    <th style="color:white;">Deportista</th>
                    <th style="color:white;">Observaciones</th>
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
                
        <form action="index.php?action=asistenciax_sesion" method="post" id="form-insert" >
            <h4 class="titulos">Consultar asistencias a Sesiones de Entrenamiento</h4>
            <input type="hidden" name="user_email" id="user_email_input"> 
            <select name="id_sesion" required>            
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
                <input type="submit" value="Ver Asistencia" class="form-botones-session">
        </form>
        <?php else: ?>
        <div id="div-botones"style='display:flex; flex-direction: row; width:100%;'>
    <!-- Opcional: Puedes mostrar un mensaje si no se encuentra el 'user_email' en la URL -->
            <form action="index.php?" method="get" id="boton3">
                <input type="hidden" name="user_email" id="user_email_input"> <!-- Input oculto para el email -->
                <button id="boton_volver" type="submit" name="action" value="asistenciax_sesion" class="boton-sub">Hacer otra consulta</button>
            </form>
        <?php endif; ?>
           
        </div> 
</div>
<!-- ============================================================================================== -->
 <style>
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}

    #fondo-asistencia{
         background-image: url('./IMG/LTL/mat.jpg');
            /* background-size: cover; Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
    }
    #form-insert{
        width: 50%;
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color:#4A0D0D;
        border: solid #D4AF37 2px;
        margin:2rem;
        padding:2rem;
    }
    #tabla-asistencia{
        width:70%;
        background-color: #4A0D0D;
        color:#D4AF37;
        font-style: italic;
        font-weight: lighter;
        letter-spacing: 0.3rem;
    }
    #encabezado{
        width: 70%;
        background-color: #4A0D0D;
        color:white;
    }
    .titulos{
         color: #D4AF37;
         font-style: italic;
         letter-spacing: 0.4rem;
         font-weight: lighter;
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
    .form-botones-session{
            background-color: transparent; 
            border:  solid #D4AF37 1px;
            border-radius: 5px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: italic;
            font-size: 1vw;
            font-weight: bold;
            color:#D4AF37;
            font-weight: lighter;
            letter-spacing: 0.6rem;
            width:40%;
            margin:2%;
    }
    .form-botones-session:hover{
        background-color: #D4AF37;
        color:#4A0D0D;
        border:#4A0D0D;
    }
    td, th{
        padding: 1%;
        font-size:1vw;
        border:solid #D4AF37 1px;
    }
    .lugarE{
        width: 55%;
    }
    table{    
        width: 100%;
        border: solid #D4AF37 1px;
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
        background-color:#4A0D0D;
        border: solid #D4AF37 0.1rem;
        font-size:1rem;
        border-radius: 3px;
        margin:1rem;
        padding:0.4rem;
        color:#D4AF37;
        font-family: 'Courier New', Courier, monospace;
        font-style: italic;
        margin: 1rem;
    }
    .boton-sub:hover{
        background-color: #D4AF37;
        color:#4A0D0D;
        font-weight: 200;
        border:#4A0D0D;
    }
    #boton1{
        width: 35%;
    }
    #boton2{
        width: 65%;
    }

</style>
<!-- ============================================================================================== -->
<script src="JS/jquery-3.7.1.min.js"></script>
<script>
    let userEmail = localStorage.getItem('UserEmail');

// Si existe 'user_email' en localStorage, asignarlo al input oculto
if (userEmail) {
    document.getElementById('user_email_input').value = userEmail;
}
</script>