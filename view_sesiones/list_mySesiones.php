<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="JS/jquery-3.7.1.min.js"></script>
    <title>Centros de Entrenamiento</title>
</head>
<style>
    html{
        font-size: 20px;
    }
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
        margin:;
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

    <?php if(isset($sesiones) && count($sesiones)>0):?>
        <h2 style="font-size: 1.2rem; font-weight: 100;">Sesiones encontradas:</h2>
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
                <?php foreach ($sesiones as $sesion): ?>
                <tr>
                   
                    <td> <?=$sesion['id']?></td>
                    <td class="lugar"> <?=$sesion['sitio']?></td>
                    <td> <?=$sesion['nombreE']?> <?= $sesion['apellidoE']?></td>
                    <td> <?=$sesion['fecha']?></td>
                    <td> <?=$sesion['hora']?></td>
                    <td>
                    <form action="index.php?action=delete_session" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?=$sesion['id']?>">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
        <?php elseif(isset($sesiones)):?>
            <p style="color: yellow; font-style: italic;">No tienes sesiones programadas</p>

        <?php endif;?> 
        <div style='display:flex; flex-direction: row; width:50%;' >
            <form action='index.php?action=principal' method='post' id="boton1">
                <button type='submit' name='action' value='principal'  class="boton-sub">Ir al inicio</button>
            </form> 
            <form action='index.php?action=trainer_manage' method='get' id="boton2">
                <button type='submit' name='action' value='trainer_manage' class="boton-sub">Sesiones de Entrenamiento</button>
            </form>
        </div>  
</div>  
</body>
</html>