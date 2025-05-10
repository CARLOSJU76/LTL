<div id="fondo-representante">
    <div id="container-general">

<?php if(isset($listaRep) && count($listaRep)>0):?>
     
        <table class="table table-bordered">
        <h2>Representante</h2>
            <thead class="th">
                <tr id="head-row">
                    <th class="head-inser">Dirigente</th>                    
                    <th class="head-inser">Tipo Doc.</th>
                    <th class="head-inser">Documento</th>
                    <th class="head-inser">Genero</th>
                    <th class="head-inser">Email</th>
                    <th class="head-inser">Telefono</th>
                    <th class="head-inser">Fotografía</th>
                    <th class="head-inser">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaRep as $rep): ?>
                <tr id="repre-row">
                    <td><?=$rep['nombreR'] . ' ' . $rep['apellidoR']?></td>
                    <td><?=$rep['tipodoc']?></td>
                    <td><?=$rep['numdoc']?></td>
                    <td><?=$rep['genero']?></td>
                    <td><?=$rep['email']?></td>
                    <td><?=$rep['telefono']?></td>
                    <td><img src="fotos/<?= $rep['foto']; ?>" width="80" alt="Foto"></td>
<!--------------------------------------------------------------------------------------------------------------- -->
                    <td class="td-botones">
                        <form action="index.php?action=update_repre" method="get" class="form-botones" style="display:inline;">
                            <input type="hidden" name="id_rep" value="<?= $rep['id'] ?>">
                            <button type="submit" id="boton-clubes1" name="action" value="update_repre" >Actualizar</button>
                        </form>
                    <!-- Formulario para eliminar -->
                        <form action="index.php?action=delete_repre" method="post" class="form-botones" style="display:inline;"  onsubmit="return confirmDelete()">
                            <input type="hidden" name="id_rep" value="<?= $rep['id'] ?>">
                            <button type="submit" id="boton-clubes2" name="action" value="delete_repre" >Borrar</but>
                        </form>
                    </td>
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
        <div id="div-label"><label id="label-buscar-rep" for="id_rep">Seleccione el representante que desea revisar.</label></div>
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
    margin-right: 5rem;
   
    width: 100%;
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
    font-size=0.6rem;
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