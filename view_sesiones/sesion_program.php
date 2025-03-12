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
        form{
            margin-top: 10%;
            width: 60%;
            display: flex; flex-direction: column;
            align-items: center;
            justify-content:space-around; background-color: #4A0D0D;
            aspect-ratio: 2/1;
            border: solid gold 1px;
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
            background-color: transparent; border: solid gold 2px; border-radius: 3px;
            color: gold;
            font-family: Arial, Helvetica, sans-serif; font-style: italic; font-size:1vw;
        }

    </style>
<body>
    <form action="index.php?action=schedule_session" method="post">
        <h2>Programación de Entrenamiento</h2>
        <select name="id_entrenador">
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
        </select>
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
</body>
</html>