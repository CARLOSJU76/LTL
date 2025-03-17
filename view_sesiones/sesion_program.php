<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <style>
        body{
            display: flex;flex-direction:column;
            align-items: center;
            width: 100%;height: 100%;
            margin:0;padding:0;
        }
        #contenedor-general{
            margin-top: 5%;
            width: 50%;
            display: flex; flex-direction: column;
            align-items: center;
            justify-content:space-around; background-color: #4A0D0D;
            border: solid gold 1px;
            border-radius: 3px;
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
<body>
<div id="contenedor-general">
    <form action="index.php?action=schedule_session" method="post">
        <h2 style="letter-spacing:0.3rem; font-weight:100;">Programación de Entrenamiento</h2>
        <input type="hidden" name="user_email" value="<?= $_GET['user_email'] ?? '' ?>">
        <!-- <select name="id_entrenador">
            <option value="">Elija un entrenador de la lista</option>
            <?php
                include_once 'controller/ClubController.php';
                $objeto= new DeportistaController();
                $entrenadores= $objeto->listEntrenadores();
                  
                foreach($entrenadores as $trainer){
                    echo"<option value='".htmlspecialchars($trainer['id'])."'>".
                    htmlspecialchars($trainer['nombreE']) ."  ". 
                    htmlspecialchars($trainer['apellidoE']) . 
                    "</option>";
                }
            ?>
        </select> -->
<!--===================================================================================-->
        <select name="id_lugar">
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
    <div style='display:flex; flex-direction: row; width:50%;' >
            <form action='index.php?action=principal' method='post' id="boton1">
                <button type='submit' name='action' value='principal'  class="boton-sub">Ir al inicio</button>
            </form> 
            <form action='index.php?action=trainer_manage' method='get' id="boton2">
                <button type='submit' name='action' value='trainer_manage' class="boton-sub">Sesiones de Entrenamiento</button>
            </form>
    </div>
</body>
</html>