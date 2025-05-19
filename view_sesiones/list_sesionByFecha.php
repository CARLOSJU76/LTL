<div id="fondo-buscarS">

    <?php if(isset($sesiones) && count($sesiones)>0):?>
        <h2 style="font-size: 0.8rem;">Sesiones encontradas:</h2>
        <table class="table-sesion">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th class="fecha-sesion">Fecha</th>
                    <th class="hora-sesion">Hora</th>
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
                    <td class="fecha-session-dato"> <?=$sesion['fecha']?></td>
                    <td class="fecha-session-dato"> <?=$sesion['hora']?></td>
                    <td class="id">
            <?php if ($sesion['email'] == $user_email): ?>
                <form action="index.php?action=delete_session" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?=$sesion['id']?>"> 
                    <button class="delete-boton" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                </form>
            <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($sesiones)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron sesiones programadas en ese rango de tiempo</p>

        <?php endif;?>     
                                                                                                                                                                                                                                                                                                        
                
        <?php
// Verificar si el parámetro 'user_email' está presente en la URL
$user_email = isset($_GET['user_email']) ? $_GET['user_email'] : null;
?>

<?php if ($user_email): ?>
    <form action="index.php?action=list_sessionByFecha" method="post"  class="form-sesion">
        <p id="rango">Para ver todas las sesiones programadas en un rango de tiempo, elige dos fechas:</p>
        
        <!-- Primer input para la fecha -->
        <input type="date" id="fecha1" class="fechaInput" name="fecha1" min="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento" class="form-control" required>
        <label for="fecha1">Selecciona la primera fecha</label>
        
        <!-- Segundo input para la fecha -->
        <input type="date" id="fecha2" class="fechaInput" name="fecha2" min="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento" class="form-control" required>
        <label for="fecha2">Selecciona la segunda fecha</label>
        
        <!-- Campo oculto para enviar el user_email -->
        <input type="hidden" name="user_email" value="<?= $user_email ?>">
        
        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Buscar Sesiones" class="form-boton" id="buscar">
    </form>
<?php else: ?>
    <!-- Opcional: Puedes mostrar un mensaje si no se encuentra el 'user_email' en la URL -->
    <form action="index.php?" method="get" id="formulario">
        <input type="hidden" name="user_email" id="user_email_input"> <!-- Input oculto para el email -->
        <button id="boton_volver" type="submit" name="action" value="list_sessionByFecha">Hacer otra consulta</button>
    </form>
<?php endif; ?>

</div>  
<!-- =================================================================================== -->

<style>
@font-face {
    font-family: 'fuente3';
    src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}

#fondo-buscarS{
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
#rango{
    width:60%; font-size:0.8rem; color: #D4AF37;
    font-style: italic;letter-spacing: 0.3rem;
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
.form-boton{
    background-color: transparent; 
    border:  solid #D4AF37 1px;
    border-radius:5px;
    font-family:Arial, Helvetica, sans-serif;
    font-style: italic;
    font-size: 1rem;
    font-weight: bold;
    color:#D4AF37;
    width:40%;
    margin:2rem;
    padding:0.4rem;
    }

.lugarE{
    width: 55%;
}
.table-sesion{    
    width: 90%;
    border: solid #D4AF37 1px;
    background-color: #4A0D0D;
}
.form-sesion{
    width: 90;
    border:solid #D4AF37 1px;
    background-color: #4A0D0D;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
th{
    padding: 1%;
    font-size:1rem;
    color:#D4AF37;
    border:solid #D4AF37 1px;
    font-style: italic;
}
td{
    padding:1%;
    font-size:0.9rem;
    color:white;
    border: #D4AF37 solid 1px;
    justify-content: center;
    align-items: center;
}
.fecha-sesion, .hora-sesion{
    color: #D4AF37;
    width: 7%;
    justify-content: center;
    align-items: center;
}
.fecha-session-dato{
    color: white;
    justify-content: center;
    align-items: center;
}
#formulario{
    margin:5%;
}
.lugar{
    width: 30%;
}
.nombreE{
    width:20%;
}
.fechaInput{
    width: 50%;
    font-size: 0.8rem;
    font-style: italic;
    padding:0.3rem;
    justify-items: center;
    border-radius: 3px;
    border:#4A0D0D solid 1px;
    background-color: #d2d2d2;

}
.id{
    width: 6%;
}
.delete-boton{
    background-color: transparent;
    color:#D4AF37;
    border: #D4AF37 solid 1px;
    font-style: italic;
    font-size: 0.5rem;
    border-radius: 3px;
}
#boton_volver{
     background-color: #4A0D0D;
    color:#D4AF37;
    border: #D4AF37 solid 1px;
    font-style: italic;
    font-size: 1rem;
    border-radius: 3px;
    padding: 0.4rem;
}
.delete-boton:hover, #boton_volver:hover, .form-boton:hover{
    background-color: #d4af37;
    color:#4A0D0D;
    border: #4A0D0D;
}
label, .rango{
    font-size:0.6rem;
    font-family: 'Courier New', Courier, monospace;
    text-justify: initial;  
    width:40%;
    font-size: 0.8rem;
    color:#D4AF37;
    padding-bottom:0.3rem;
    padding-top:0.1 rem;
    font-style: italic;
}
.boton-sub{
    width: 98%;
    background-color: transparent;
    border: solid #D4AF37 0.05rem;
    font-size:0.6rem;
    border-radius: 3px;
    margin:1rem;  
    padding:0.3rem;
    color:#D4AF37;
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
<!-- =================================================================================== -->
<script>
    let userEmail = localStorage.getItem('UserEmail');

// Si existe 'user_email' en localStorage, asignarlo al input oculto
if (userEmail) {
    document.getElementById('user_email_input').value = userEmail;
}
</script>
 <script src="JS/jquery-3.7.1.min.js"></script>