<?php   if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $email_user = $_SESSION['email'] ?? 'No encontrado';
        $perfil= $_SESSION['perfil'] ?? 'No encontrado';

    include_once './controller/ClubController.php';
    $objeto= new ClubController();
    $club= $objeto->getClub_byRepre_Email($email_user);
    $codigo_club = $club['codigo'] ?? '';
    $nombre_club= $club['nombreClub'] ?? '';
?>


<div id="fondo-representante">
    <div id="container-general">

<?php if(isset($deportistas) && count($deportistas)>0):?>

        <table class="table table-bordered">
        <h2>Deportistas Club <?php echo $nombre_club?> </h2>
            <thead class="th">
                <tr id="head-row">
                    <th class="head-inser">Deportista</th>
                    <th class="head-inser">Tipo Doc</th>
                    <th class="head-inser">Documento</th>
                    <th class="head-inser">Fecha Nac.</th>
                    <th class="head-inser">Genero</th>
                    <th class="head-inser">Lugar Nac.</th>
                    <th class="head-inser">Teléfono</th>
                    <th class="head-inser">Domicilio</th>
                    <th class="head-inser">Email</th>
                    <th class="head-inser">Modalidad</th>
                    <th class="head-inser">Club</th>
                    <th class="head-inser">Fotografía</th>
                    <th class="head-inser">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($deportistas as $depor): ?>
                    <?php if($depor['codigo_club'] == $codigo_club): ?>
                <tr id="repre-row">
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

<!--------------------------------------------------------------------------------------------------------------- -->
                    <td class="td-botones">
                        <form action="index.php?action=update_deportista" method="get" class="form-botones" style="display:inline;">
                            <input type="hidden" name="id_dep" value="<?= $depor['id'] ?>">
                            <button type="submit" id="boton-clubes1" name="action" value="update_deportista" >Actualizar</button>
                        </form>
                    <!-- Formulario para eliminar -->
                        <form action="index.php?action=delete_deportista" method="post" class="form-botones" style="display:inline;"  onsubmit="return confirmDelete()">
                            <input type="hidden" name="id_dep" value="<?= $depor['id'] ?>">
                            <button type="submit" id="boton-clubes2" name="action" value="delete_deportista" >Borrar</but>
                        </form>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($deportistas)):?>
            <p>No se encontraron usuarios con ese nombre</p>
        <?php endif;?>
<!-- ================================================================================================================ -->
        <form action="index.php?action=search_deportista" method="get" id="form_buscar_club">
            <input type="hidden" name="action" value="search_deportista">
            <input type="hidden" name="viene_de" value="deportista_Rep">

            <select name="id_dep" id="id_rep" class="form-select" required>
                <option value="">Elija el Deportista</option>
                <?php
                  include_once './controller/DeportistaController.php';
                  $deporCon= new DeportistaController();
                  $arrayDep= $deporCon->listSportman();

                    foreach($arrayDep as $deporre1){
                        if($deporre1['codigo_club'] == $codigo_club){
                             echo"<option value='".htmlspecialchars($deporre1['id'])."'>".
                        htmlspecialchars($deporre1['nombres']) ."  ".
                        htmlspecialchars($deporre1['apellidos']) .
                        "</option>";
                        }
                    }
                ?>
            </select><br>
            <input type="submit" value="Buscar" id="buscar_club">
        </form>
        <div id="label-buscar-rep"><label  for="id_rep">Seleccione el Deportista a consultar.</label></div>
<!-- ====================================================================================================================== -->
    </div>
</div>
<!-- ============================================================================================================= -->
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
#fondo-representante{
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
}
#container-general{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width:90%;
    overflow: scroll;
    background-color: #4A0D0D;
    border: #D4AF37 solid 1px;
    border-radius: 3px;
    margin:1rem;
}
.table {
    max-width: 90%;
    background-color: white;
    border-radius: 4px;
    border: 1px solid #ddd;
    margin: 1rem;
}
#head-row{
    background-color: #4A0D0D;
    color:#D4AF37;
}
#repre-row{
    background-color: white;
    font-size: 0.8rem;
    border:#D4AF37 solid 1px;
}
.td-botones{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    align-items: center;
}
button {
    background-color: transparent;
    color: #4A0D0D;
    border-radius: 3px;
    font-size: 0.5rem;
    padding: 0.5rem;
    border: #4A0D0D solid 1px;
    width: 4rem;
}
h2{
    font-family:'Courier New', Courier, monospace;
    font-size: 2rem;
    font-weight: 100;
    color:#D4AF37;
}
#form_buscar_club{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    width:85%;
    padding:0.2rem;
    font-size: 0.8rem;
    border:#D4AF37 solid 1px;
   }
#label-buscar-rep{
    color:white;
    font-family:'Courier New', Courier, monospace;
    width: 85%;
    margin-bottom:1.5rem;
    margin-top:0.5rem;

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
.head-inser{
    background-color: #7A1F1F;
    font-family: 'Courier New', Courier, monospace;
    font-size:0.6rem;
    padding:0.3rem;
    border: #D4AF37 solid 1px;
    border-radius: 4px;
}
button:hover {
    background-color:#D4AF37;
    color:#4A0D0D;
}
input, select {
    padding: 0.5rem;
    font-size: 1.2rem;
    border-radius: 4px;
}
#id_rep{
    height: 100%;
    width: 49%;
    font-size: 0.8rem;
}
#div-label{
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;justify-content: flex-start;
    padding-left:10rem;
    padding-top: 0.5rem;
    padding-bottom: 2rem;
}
</style>
<!-- ============================================================================================================= -->
<!-- ============================================================================================================= -->

