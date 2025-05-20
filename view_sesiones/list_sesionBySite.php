<div class="form-insert">

    <?php if(isset($sesiones) && count($sesiones)>0):?>
       
        <table id="table-sesion" class="table-sesion">
            <thead>
                  <h2 class="titulos-sesion">Sesiones encontradas:</h2>
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
                    $user_email = $_POST['user_email'] ?? '';
                    foreach ($sesiones as $sesion): ?>
                <tr>
                   
                    <td> <?=$sesion['id']?></td>
                    <td class="lugar"> <?=$sesion['sitio']?></td>
                    <td> <?=$sesion['nombreE']?></td>
                    <td> <?=$sesion['fecha']?></td>
                    <td> <?=$sesion['hora']?></td>
                    <td>
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
            <p style="color: yellow; font-style: italic;">No se encontraron sesiones programadas en este lugar de entrenamiento</p>

        <?php endif;?>  
   <!-- Formulario para buscar sesiones programadas por lugar de entrenamiento -->
   <?php $user_email = isset($_GET['user_email']) ? $_GET['user_email'] : null; ?>
                
        <form action="index.php? action=list_sessionBySite" method="post"  id="form-sesion">
             <h2 class="titulos-sesion">Elige un escenario</h2>
            <input type="hidden" name="user_email" id="user_email_input"> 
            <select name="id_lugar">
            
                    <option value="">Elija una Opción</option>
                    <?php
                        include_once 'controller/ElementosController.php';
                        $objeto=new ElementosController();
                        $sitios=$objeto->listLugares();
                        foreach($sitios as $sitio){
                            echo"<option value='".htmlspecialchars($sitio['id'])."'>".
                            htmlspecialchars($sitio['lugar']).
                            "</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Buscar Sesiones" class="form-botones-sesion">
        </form>
</div> 
<!-- ============================================================================================== -->
<style>
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}
    .form-insert{
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
    #form-sesion{  
        width: 60%;
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color:#4A0D0D;
        border: solid gold 2px;
        margin-bottom: 3%;
    }
    #table-sesion{
        width: 80%;
        background-color:#4A0D0D;
        color: #D4AF37;
        font-style: italic;
        border: solid gold 2px;
        margin-bottom: 3%;
        padding:1%;
    }
    .titulos-sesion{
        width: 80%;
        font-family: 'fuente3';
        font-size: 1.8rem;
        font-weight: lighter;
        color: gold;
        font-style: italic;
        letter-spacing: 0.3rem;
        text-align: center;
        margin-bottom: 2%;
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
    .form-botones-sesion{
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
</style>

<script>

    let userEmail = localStorage.getItem('UserEmail');

// Si existe 'user_email' en localStorage, asignarlo al input oculto
if (userEmail) {
    document.getElementById('user_email_input').value = userEmail;
}
</script>
<script src="JS/jquery-3.7.1.min.js"></script>