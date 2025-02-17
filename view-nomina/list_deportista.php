<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deportistas LTL</title>
        <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/listar_repre.css">
    <style>
        body{
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
         
.container, .form-select{
    border: 3px solid white ;
    padding-top:0;
    width: 95%;
}
#tabla_inser_clubes{
    background-color: whitesmoke;
    width:100%;
}
#formulario_inserclubes{
    margin-top: 0;
    width: 90%;
}
#boton_submit{ 
    background: linear-gradient(to bottom, #ffd700, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1.2vw;
   font-weight: bold;
    color:#4A0D0D;
}
#head-inser_club{
    background-color: #7A1F1F;
}
.form-control, .form-select{
    width: 58%;
    height: 100%;
    margin-bottom: 1%;
    text-justify: center;
    font-family:'Courier New', Courier, monospace;
    font-size: 1.2vw;
    
}
h2{
    font-family:'Courier New', Courier, monospace;
    font-size: 2vw;
    color:white;
}
#form_buscar_club{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    width:100%;
    padding:0;
    height: 2.2vw;
   
   }
label{
    color:white;
    font-family:'Courier New', Courier, monospace;
   
    width: 100%;
}
#codigo_club{
    width:60%;
    text-align: center;
    padding:0;
  font-size: 1vw;
  margin:0;           
}
#buscar_club{
    width:49%;
    height: 100%;
    background: linear-gradient(to bottom, #ffd700, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1vw;
    font-weight: bold;
    color:#4A0D0D;
    border:none;
}
#head-inser1, #head-inser2,#head-inser3,#head-inser4{
    background-color: #7A1F1F;
    font-family:'Courier New', Courier, monospace;
    font-size: 1vw;
}
#container_general{
    overflow: auto;
    width: 95%;
}
    </style>
</head>
<body>

<div class="container" id="container_general" >

<?php if(isset($deportistas) && count($deportistas)>0):?>
        <h2>Deportistas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Deportista</th>                    
                    <th>Tipo Doc.</th>
                    <th>Documento</th>
                    <th>fecha Nac.</th>
                    <th>Genero</th>
                    <th>Lugar Nac.</th>
                    <th>Teléfono</th>
                    <th>Domicilio</th>
                    <th>Email</th>
                    <th>Modalidad</th>
                    <th>Club</th>
                    <th>Fotografía</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($deportistas as $depor): ?>
                <tr>
                    <td><?=$depor['nombreD'] . ' ' . $depor['apellidoD']?></td>
                    <td><?=$depor['tipodoc']?></td>
                    <td><?=$depor['id']?></td>                   
                    <td><?=$depor['fecha']?></td>
                    <td><?=$depor['genero']?></td>
                    <td><?=$depor['pais'].'/'.$depor['departamento'].'/'.$depor['ciudad']?></td>
                    <td><?=$depor['telefono']?></td>
                    <td><?=$depor['direccion']?></td>                  
                    <td><?=$depor['email']?></td>
                    <td><?=$depor['modalidad']?></td>
                    <td><?=$depor['club']?></td>
                    <td><img src="fotos/<?= $depor['foto']; ?>" width="100" alt="Foto"></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($deportistas)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron deportistas con ese nombre</p>

            <?php endif;?>
<!-- ================================================================================================================ -->
<form action="index.php?action=search_deportista" method="get" id="form_buscar_club">
    <input type="hidden" name="action" value="search_deportista">
    
        
        <select name="id_dep" id="id_dep" class="form-select" required>
            <option value="">Elija Deportista</option>
            <?php
                  
                foreach($deportistas as $depor){
                    echo"<option value='".htmlspecialchars($depor['id'])."'>".
                    htmlspecialchars($depor['nombreD']) ."  ". 
                    htmlspecialchars($depor['apellidoD']) . 
                    "</option>";
                }
            ?>
        </select><br>
        <input type="submit" value="Buscar Deportista" id="buscar_club">        
    </form>
    <label for="id_dep">Seleccione el Deportista que desea revisar.</label>

    <div id="div-botones">
        <!-- ====BOTON PARA ACTUALIZAR===================================================================================== -->
    <form action="index.php?action=update_deportista" method="get"  class="form-botones">
        <input type="hidden" name="id_dep" value="<?= $_GET['id_dep'] ?? '' ?>">
        <button type="submit" name="action" value="update_deportista" class="botones">Actualizar datos</button>
    </form>
    <!-- BOTON PARA ELIMINAR=========================================================================================================== -->
    <form action="index.php?action=delete_deportista" method="get" class="form-botones">
        <input type="hidden" name="id_dep" value="<?= $_GET['id_dep'] ?? '' ?>">
        <button type="submit" name="action" value="delete_deportista" class="botones">Desvincular Deportista</button>
    </form>
<!-- ==== RESULTADOS DE LA CONSULTA==================================================================================================== -->
    <form action="index.php?action=sport_manage" method='get' enctype="multipart/form-data" class="form-botones">
        <button type="submit" name="action" value="sport_manage" class="botones">Gestión de Deportistas</button>
    </form>
    <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
    </form>
        
    </div>


</div>
    
</body>
</html>