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
    html{
        font-size: 30px;
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
        border: solid gold 0.1rem;
        border-radius: 3px;
        margin-top: 0.2rem;
    }
    .form-insert{
        width: 90%;
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
    .fecha{
        width: 7%;
    }
    .lugar{
        width: 30%;
    }
    .nombreE{
        width:20%;
    }
    .fechaInput{
        width: 40%;
        font-size: 0.6rem;
        padding:0.2rem;
        border-radius: 3px;
        margin-top: 1%;
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
</style>

<body>
<div class="form-insert">
    <?php if(isset($sesiones) && count($sesiones)>0):?>
        <h2 style="font-size: 0.8rem;">Sesiones encontradas:</h2>
        <table>
            <thead>
                <tr>
                  
                    <th>No.</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtener el valor de 'user_email' desde la URL (query string)
                $user_email = $_POST['user_email'] ?? '';
                ?>
                <?php foreach ($sesiones as $sesion): ?>
                <tr>
                   
                    <td class="id"> <?=$sesion['id']?></td>
                    <td class="lugar"> <?=$sesion['sitio']?></td>
                    <td class="nombreE"> <?=$sesion['nombreE']?> <?=$sesion['apellidoE']?> </td>
                    <td class="fecha"> <?=$sesion['fecha']?></td>
                    <td class="fecha"> <?=$sesion['hora']?></td>
                    <td class="id">
            <?php if ($sesion['email'] == $user_email): ?>
                <form action="index.php?action=delete_session" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?=$sesion['id']?>"> 
                    <button class="delete-boton" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                </form>
            <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($sesiones)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron sesiones programnadas en ese rango de tiempo</p>

        <?php endif;?>     
                                                                                                                                                                                                                                                                                                        
                
        <?php
// Verificar si el parámetro 'user_email' está presente en la URL
$user_email = isset($_GET['user_email']) ? $_GET['user_email'] : null;
?>

<?php if ($user_email): ?>
    <form action="index.php?action=list_sessionByFecha" method="post" style="width: 96%;" class="form-insert" id="formulario">
        <p class="rango" style="width:60%;">Para ver todas las sesiones programadas en un rango de tiempo, elige dos fechas:</p>
        
        <!-- Primer input para la fecha -->
        <input type="date" id="fecha1" class="fechaInput" name="fecha1" min="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento" class="form-control" required>
        <label for="fecha1">Selecciona la primera fecha</label>
        
        <!-- Segundo input para la fecha -->
        <input type="date" id="fecha2" class="fechaInput" name="fecha2" min="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento" class="form-control" required>
        <label for="fecha2">Selecciona la segunda fecha</label>
        
        <!-- Campo oculto para enviar el user_email -->
        <input type="hidden" name="user_email" value="<?= $user_email ?>">
        
        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Buscar Sesiones" class="form-botones" id="buscar">
    </form>
<?php else: ?>
    <!-- Opcional: Puedes mostrar un mensaje si no se encuentra el 'user_email' en la URL -->
    <form action="index.php?" method="get" id="formulario">
    <input type="hidden" name="user_email" id="user_email_input"> <!-- Input oculto para el email -->
    <button id="boton_volver" type="submit" name="action" value="list_sessionByFecha">Hacer otra consulta</button>
</form>
<?php endif; ?>

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