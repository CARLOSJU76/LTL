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
        width: 80%;
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
    }
    .form-botones{
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: italic;
            font-size: 1.2vw;
            font-weight: bold;
            color:#4A0D0D;
            width:30%;
            margin:2%;
        }
    td{
        width: 15%;
        padding: 2%;
    }
    .lugarE{
        width: 55%;
    }
    table{
    
        width: 100%;
    }
</style>

<body>

<div class="form-insert">
    <?php if(isset($lugares) && count($lugares)>0):?>
        <h2>Sitios de Entrenamiento</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre/Dirección</th>
                    <th>Pais</th>
                    <th>Dpto/Estado</th>
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lugares as $lugar): ?>
                <tr>
                    <td class="lugarE">*<?=$lugar['lugar']?></td>
                    <td>- <?=$lugar['pais']?></td>
                    <td>- <?=$lugar['dpto']?></td>
                    <td>- <?=$lugar['ciudad']?></td>
        
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($deportistas)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron lugares con ese nombre</p>

        <?php endif;?>

            
</div>
<!-- ======================================================================================== -->

<form action="index.php?action=search_lugar" method="get" class="form-insert">
    <input type="hidden" name="action" value="search_lugar">
    
        
        <select name="id_lugar" id="id_lugar" class="form-select" required>
            <option value="">Elija un Sitio</option>
            <?php
                  
                foreach($lugares as $lugar){
                    echo"<option value='".htmlspecialchars($lugar['id'])."'>".
                    htmlspecialchars($lugar['lugar']) .
                    
                    "</option>";
                }
            ?>
        </select><br>
        <input type="submit" value="Buscar Sitio de Entrenamiento" id="buscar_club">        
    </form>
    <label for="id_lugar">Seleccione el Deportista que desea revisar.</label>
<!-- ======================================================================================== -->


    <form action="index.php?action=insert_lugar" method="post" class="form-insert">
        <h2>Inserción lugares de Entrenamiento</h2>
            <input type="text" name="lugar" placeholder="Escriba el nombre del lugar">

            <div id="menu">
<!-- ============================================================================================================================= -->
                <div id="uno">
                    <select id="pais"  class="form-select" name="pais" required>
                        <option value="">Elige país</option>   
                    </select>
                </div>
<!-- ============================================================================================================================= -->
                <div id="dos">
                    <select id="departamento"  class="form-select" name="dpto" style="display:none;" required>
                        <option value="">Elije departamento</option>
                    </select>
                </div>
<!-- ============================================================================================================================== -->
                <div id="tres">
                    <select id="ciudad" name="ciudad"  class="form-select" style="display:none;" required>
                        <option value="">Elije ciudad</option>
                    </select>
                </div>
<!-- =============================================================================================================================== -->
            </div>
            <button type="submit" class="form-botones" id="boton_submit">Guardar Datos</button>

    </form>

    <script src="JS/co-dpt-ci.js"></script>
</body>
</html>