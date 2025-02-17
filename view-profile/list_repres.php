<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Vehículos</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/listar_repre.css">
    <style>

<?php 
    $mensaje=0;
    if($mensaje==1){?>
        .errors{
        display:block;}
        <?php } else {?>
        .errors{
            display:none;
        }   
         
       <?php }?>

    
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
#head-inser1, #head-inser2, #head-inser3, #head-inser4, #head-inser5, #head-inser6{
    background-color: #7A1F1F;
}
    </style>
</head>
<body>

<div class="container mt-4" id="container" >

<?php if(isset($listaRep) && count($listaRep)>0):?>
        <h2>Representante</h2>
        <table class="table table-bordered">
            <thead class="th">
                <tr>
                    <th id="head-inser1">Dirigente</th>                    
                    <th id="head-inser2">Tipo Doc.</th>
                    <th id="head-inser3">Documento</th>
                    <th id="head-inser4">Genero</th>
                    <th id="head-inser5">Email</th>
                    <th id="head-inser6">Telefono</th>
                    <th id="head-inser6">Fotografía</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaRep as $rep): ?>
                <tr>
                    <td><?=$rep['nombreR'] . ' ' . $rep['apellidoR']?></td>
                    <td><?=$rep['tipodoc']?></td>
                    <td><?=$rep['numdoc']?></td>
                    <td><?=$rep['genero']?></td>
                    <td><?=$rep['email']?></td>
                    <td><?=$rep['telefono']?></td>
                    <td><img src="fotos/<?= $rep['foto']; ?>" width="100" alt="Foto"></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($listaRep)):?>
            <p>No se encontraron usuarios con ese nombre</p>

            <?php endif;?>
<!-- ================================================================================================================ -->
<form action="index.php?action=search_repres" method="get" id="form_buscar_club">
    <input type="hidden" name="action" value="search_repres">
    
        
        <select name="id_rep" id="id_rep" class="form-select" required>
            <option value="">Elija Representante</option>
            <?php
                  include_once './controller/ClubController.php';
                  $repreCon= new ClubController();
                  $arrayRep= $repreCon->getRepresentante();

                foreach($arrayRep as $repre1){
                    echo"<option value='".htmlspecialchars($repre1['id'])."'>".
                    htmlspecialchars($repre1['nombres']) ."  ". 
                    htmlspecialchars($repre1['apellidos']) . 
                    "</option>";
                }
            ?>
        </select><br>
        <input type="submit" value="Buscar" id="buscar_club">        
    </form>
    <label for="id_rep">Seleccione el representante que desea revisar.</label>

    <div id="div-botones">
        <!-- ====BOTON PARA ACTUALIZAR===================================================================================== -->
    <form action="index.php?action=update_repre" method="get"  class="form-botones">
        <input type="hidden" name="id_rep" value="<?= $_GET['id_rep'] ?? '' ?>">
        <button type="submit" name="action" value="update_repre" class="botones">Actualizar datos</button>
    </form>
    <!-- BOTON PARA ELIMINAR=========================================================================================================== -->
    <form action="index.php?action=delete_repre" method="get" class="form-botones">
        <input type="hidden" name="id_rep" value="<?= $_GET['id_rep'] ?? '' ?>">
        <button type="submit" name="action" value="delete_repre" class="botones">Quitar Repre</button>
    </form><br>
<!-- ==== RESULTADOS DE LA CONSULTA==================================================================================================== -->
    <form action="index.php?action=club_manage" method='get' enctype="multipart/form-data" class="form-botones">
        <button type="submit" name="action" value="club_manage" class="botones">Gestión de Clubes</button>
    </form>
    <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
    </form>
        
    </div>

    <?php  echo "<p style='color:white'> $mensaje </p>" ?>
    
    <span class="errors text-center" style="background-color: blue; color:white; " >
        <p>Para actualizar representante debe elegirlo y pulsar  el botón buscar</p>
    </span>

</div>
    
</body>
</html>