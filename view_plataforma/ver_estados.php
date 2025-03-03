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

        <h2>CONSULTA DE ESTADOS FINANCIEROS</h2>
        <form action="index.php?action=ver_estadosf" method="post">
            <select>
                <option value="">Elija un año</option>
                <?php 
                    foreach ($estadosf as $esta){
                        echo    "<option value= '" . htmlspecialchars ($esta['id']) . "'>".
                                htmlspecialchars($esta['nualidad'])."</option>";
                    }
                ?>
            </select>
        </form>
        <?php if(isset($estadobyId) && count($estBy)>0):?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>AÑO</th>                    
                </tr>
            </thead>
            <tbody>
               
                <tr>
                   
                    <td>
                        IMAGEN
                        <!-- <img src="fotos/<?= $depor['foto']; ?>" width="100" alt="Foto"> -->
                    </td>
                    
                </tr>
        
            </tbody>
        </table>
        <?php elseif(isset($estadobyId)):?>
            <p style="color: yellow; font-style: italic;">No se encontraron documentos la nualidad elegida</p>

            <?php endif;?>
       

        <!-- ====BOTON PARA ACTUALIZAR===================================================================================== -->
   
<!-- ==== RESULTADOS DE LA CONSULTA==================================================================================================== -->
    <div id="div-botones">
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