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
<!-- =========================================================================== -->
<div id="fondo-representante">
    <div id="container-general">

<?php if(isset($entrenadores) && count($entrenadores)>0):?>

        <table class="table table-bordered">
        <h2>Entrenadores Club <?php echo $nombre_club?> </h2>
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
                    <th class="head-inser">Club</th>
                    <th class="head-inser">Fotografía</th>
                    <th class="head-inser">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($entrenadores as $trainer): ?>
                      <?php if($trainer['codigo_club'] == $codigo_club): ?>
                <tr id="repre-row">
               <td><?=$trainer['nombreE'] . ' ' . $trainer['apellidoE']?></td>
                    <td><?=$trainer['tipodoc']?></td>
                    <td><?=$trainer['id']?></td>                   
                    <td><?=$trainer['fecha']?></td>
                    <td><?=$trainer['genero']?></td>
                    <td><?=$trainer['pais'].'/'.$trainer['departamento'].'/'.$trainer['ciudad']?></td>
                    <td><?=$trainer['telefono']?></td>
                    <td><?=$trainer['direccion']?></td>                  
                    <td><?=$trainer['email']?></td>
                    <td><?=$trainer['club']?></td>
                    <td><img src="fotos/<?= $trainer['foto']; ?>" width="100" alt="Foto"></td>
<!--------------------------------------------------------------------------------------------------------------- -->
                    <td class="td-botones">
                        <form action="index.php?action=update_entrenador" method="get" class="form-botones" style="display:inline;">
                            <input type="hidden" name="id_ent" value="<?= $trainer['id'] ?>">
                            <button type="submit" id="boton-clubes1" name="action" value="update_entrenador" >Actualizar</button>
                        </form>
                    <!-- Formulario para eliminar -->
                        <form action="index.php?action=delete_entrenador" method="post" class="form-botones" style="display:inline;"  onsubmit="return confirmDelete()">
                            <input type="hidden" name="id_ent" value="<?= $trainer['id'] ?>">
                            <button type="submit" id="boton-clubes2" name="action" value="delete_entrenador" >Borrar</but>
                        </form>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($entrenadores)):?>
            <p>No se encontraron usuarios con ese nombre</p>
        <?php endif;?>
<!-- ================================================================================================================ -->
      <form action="index.php?action=search_entrenador" method="get" id="form_buscar_club">
    <input type="hidden" name="action" value="search_entrenador">
    <input type="hidden" name="viene_de" value="entrenador_rep">
    
        
        <select name="id_ent" id="id_ent" class="form-select" required>
            <option value="">Elija un Entrenador de la lista</option>
            <?php
                  
                include_once 'controller/DeportistaController.php';
                $dc= new DeportistaController();
                $entrenadores1= $dc->getEntrenadores();

                foreach($entrenadores1 as $trainer1){
                     if($trainer1['codigo_club'] == $codigo_club){
                         echo"<option value='".htmlspecialchars($trainer1['id'])."'>".
                    htmlspecialchars($trainer1['nombres']) ."  ". 
                    htmlspecialchars($trainer1['apellidos']) . 
                    "</option>";
                     }
                   
                }
            ?>
        </select><br>
        <input type="submit" value="Buscar Entrenador" id="buscar_club">        
    </form>
    <label for="id_ent">Seleccione el Entrenador que desea revisar.</label>

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


