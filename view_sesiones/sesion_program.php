
<?php if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $email_user = $_SESSION['email'] ?? 'No encontrado';
                    $perfil= $_SESSION['perfil'] ?? 'No encontrado';
?>
<div id="fondo-session">
    <div id="contenedor-general">
        <form action="index.php?action=schedule_session" method="post">
            <h2 style="letter-spacing:0.3rem; font-weight:100;">Programación de Entrenamiento</h2>
            <input type="hidden" name="user_email" value="<?php echo htmlspecialchars($email_user)?>"><br> 
<!--===================================================================================-->
            <select name="id_lugar" requiered>
                <option value="">Elija un Sitio de Entrenamiento</option>
                <?php
                    include_once 'controller/ElementosController.php';
                    $objeto1= new ElementosController();
                    $lugares= $objeto1->listLugares();
                    foreach($lugares as $sitio){
                        echo"<option value='".htmlspecialchars($sitio['id'])."'>".
                        htmlspecialchars($sitio['lugar']).
                        "</option>";
                    }
                ?>
            </select>
<!--===================================================================================-->
            <div>
            <?php date_default_timezone_set('America/Bogota'); ?>
                <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" placeholder="fecha del evento" class="form-control" required>
                <label for="fecha" id="label-fecha">Fije fecha de la Sesión</label>
            </div>
<!--===================================================================================-->
            <div>
                <input type="time" id="hora" name="hora" class="form-control" required>
                <label for="hora" id="label-fecha">Fije hora de la Sesión</label>
            </div>
<!--===================================================================================-->
            <input type="submit" value="Programar Entrenamiento" id="submit">
        </form>
    </div>
</div>

    <style>
        #fondo-session{
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

    
#contenedor-general{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width:60%;
    background-color: #4A0D0D;
    border: #D4AF37 solid 1px;
    border-radius: 3px;
    margin:1rem;
}
        form{
            margin-top: 2%;
            width: 80%;
            display: flex; flex-direction: column;
            align-items: center;
            justify-content:space-around; background-color: transparent;
            aspect-ratio: 2/1;
            
        }
        h2{
            color: white; font-family: Arial, Helvetica, sans-serif; font-style: italic;
        }
        select{
            font-family:Arial, Helvetica, sans-serif; font-size: 1vw; font-style: italic;
            width: 60%; padding:1%; 
            text-align: center;
        }
        option{
            font-family: Arial, Helvetica, sans-serif; font-style: italic; font-size:0.8vw;
        }
        label{
            color:white; width: 100%; font-family: Arial, Helvetica, sans-serif;font-style: italic;
        }
        input{
            font-family: Arial, Helvetica, sans-serif; font-style: italic; font-size:1vw;
            width: 100%; padding: 0.5%;
        }
        div{
            width: 60%;
        }
        #submit{
            width: 60%;
            background-color: transparent; border: solid gold 0.1rem; border-radius: 3px;
            color: gold;
            font-family: Arial, Helvetica, sans-serif; font-style: italic; font-size:1vw;
            letter-spacing: 0.3rem;
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

