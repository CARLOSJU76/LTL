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
    .lugar{
        width: 40%;
    }
</style>

<body>
<div class="form-insert">
    <?php if(isset($sesiones) && count($sesiones)>0):?>
        <h2>Sesiones encontradas:</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sesiones as $sesion): ?>
                <tr>
                   
                    <td> <?=$sesion['id']?></td>
                    <td class="lugar"> <?=$sesion['sitio']?></td>
                    <td> <?=$sesion['nombreE']?></td>
                    <td> <?=$sesion['fecha']?></td>
                    <td> <?=$sesion['hora']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($sesiones)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron sesiones dirigidas por el entrenador</p>

        <?php endif;?>     
                                                                                                                                                                                                                                                                                                        
                
        <form action="index.php? action=list_sessionByFecha" method="post" style="width: 96%;" class="form-insert" id="formulario">
        <input type="date" id="fecha1" name="fecha1" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" placeholder="fecha del evento" class="form-control" required>
        <input type="date" id="fecha2" name="fecha2" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" placeholder="fecha del evento" class="form-control" required>
            <input type="submit" value="Buscar Sesiones" class="form-botones">
        </form>
</div>  
</body>
</html>