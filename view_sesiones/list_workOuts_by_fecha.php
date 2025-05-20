<div id="form-insert">
    <?php if(isset($workouts) && count($workouts)>0):?>
       
        <table id="table-sesiones">
             <h2 class="titulos">Entrenamientos finalizados:</h2>
            <thead>
                <tr>
                  
                    <th>No.</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Asistentes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtener el valor de 'user_email' desde la URL (query string)
                $user_email = $_POST['user_email'] ?? '';
                ?>
                <?php foreach ($workouts as $workout): ?>
                <tr>
                   
                    <td class="id"> <?=$workout['id']?></td>
                    <td class="lugar"> <?=$workout['lugar']?></td>
                    <td class="nombreE"> <?=$workout['nombreE']?> <?=$workout['apellidoE']?> </td>
                    <td class="fecha-session"> <?=$workout['fecha']?></td>
                    <td class="fecha-session"> <?=$workout['hora']?></td>
                    <td class="fecha-session"> <?=$workout['total_asistentes']?></td>
                  
           
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($workout)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron sesiones programnadas en ese rango de tiempo</p>

        <?php endif;?>     
                                                                                                                                                                                                                                                                                                        
                
        <?php
// Verificar si el parámetro 'user_email' está presente en la URL
$user_email = isset($_GET['user_email']) ? $_GET['user_email'] : null;
?>

<?php if ($user_email): ?>
    <form action="index.php?action=list_workout_byFecha" method="post"  id="form-session">
        <p class="titulos">Para ver todos los entrenamientos finalizados en un rango de tiempo, elige dos fechas:</p>
        
        <!-- Primer input para la fecha -->
        <?php date_default_timezone_set('America/Bogota'); ?>

        <input type="date" class="fechaInput" name="fecha1" max="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento"  required>
        <label class="fechaInput" for="fecha1">Selecciona la primera fecha</label>
        
        <!-- Segundo input para la fecha -->
        <input type="date"  class="fechaInput" name="fecha2" max="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento"  required>
        <label  class="fechaInput" for="fecha2">Selecciona la segunda fecha</label>
        
        <!-- Campo oculto para enviar el user_email -->
        <input type="hidden" name="user_email" value="<?= $user_email ?>">
        
        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Buscar Sesiones" class="form-boton-sesion" id="buscar">
    </form>
<?php else: ?>
    <!-- Opcional: Puedes mostrar un mensaje si no se encuentra el 'user_email' en la URL -->
    <form action="index.php?" method="get" id="form-boton-back">
    <input type="hidden" name="user_email" id="user_email_input"> <!-- Input oculto para el email -->
    <button id="boton_volver" type="submit" name="action" value="list_workout_byFecha">Hacer otra consulta</button>
</form>
<?php endif; ?>

</div>  
<!-- ============================================================================ -->
 <style>
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}
    #form-insert{
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        color:white;
    }
    #form-session{
        width: 60%;
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color: #4A0D0D;
        border: solid gold 2px;
        margin-bottom: 3%;
        padding:1%;
    }
    #table-sesiones{
        background-color: #4A0D0D;
        border:black solid 2px;
    }
    .titulos{
        font-size: 1rem;
        color:  #D4AF37;
    }
    .fechaInput{
        width: 60%;
        font-size: 0.8rem;
        font-style: italic;
        padding:0.3rem;
    }
    option{
        font-size: 0.8vw;
        font-style: italic;
    }
    select{
        font-size: 0.8rem;
        font-style:italic;
        padding: 1%;
        width: 40%;
    }
    .form-boton-sesion{           
            background-color: transparent; 
            border:#D4AF37 solid 1px;
            border-radius: 4px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: italic;
            font-size: 1rem;
            font-weight: normal;
            color:#D4AF37;
            width:40%;
            margin:1rem;
            padding:0.4rem;
        }
         .form-boton-sesion:hover{
            background-color: #D4AF37;
            color: #4A0D0D;
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
    #form-boton-back{
        margin:5%;
    }
    .fecha-session{
        width: 7%;
    }
    .lugar{
        width: 30%;
    }
    .nombreE{
        width:20%;
    }
    .id{
       width: 6%;
    }
    .delete-boton{
        background-color: transparent;
        color:white;
        border:none;
        font-style: italic;
        font-size: 0.3rem;
    }
    label, .rango{
        font-size:0.6rem;
        font-family: 'Courier New', Courier, monospace;
        text-justify: initial;
      
        width:40%;
    }
    .boton-sub{
        width: 98%;
        background-color: transparent;
        border: solid gold 0.05rem;
        font-size:0.5rem;
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
<script src="JS/jquery-3.7.1.min.js"></script>
<script>
    let userEmail = localStorage.getItem('UserEmail');

// Si existe 'user_email' en localStorage, asignarlo al input oculto
if (userEmail) {
    document.getElementById('user_email_input').value = userEmail;
}
</script>