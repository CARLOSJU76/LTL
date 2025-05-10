
<div id="fondo-repres">
<div class="container mt-4" id="contenedor-general" >

<?php if(isset($listaRep) && count($listaRep)>0):?>
        <h2>Representante</h2>
        <table class="table table-bordered" id:"table-repre">
            <thead class="th">
                <tr id="head-repre">
                    <th class="head-repre">Dirigente</th>                    
                    <th class="head-repre">Tipo Doc.</th>
                    <th class="head-repre">Documento</th>
                    <th class="head-repre">Genero</th>
                    <th class="head-repre">Email</th>
                    <th class="head-repre">Telefono</th>
                    <th class="head-repre">Fotografía</th>
                    <th class="head-repre">Acciones</th>
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
                <td class="td-botones">
                    <!--  -->
                    <form action="index.php?action=update_club" method="get" class="form-botones" style="display:inline;">
                        <input type="hidden" name="codigo_club" value="<?= $rep['id'] ?>">
                        <button type="submit" id="boton-clubes1" name="action" value="update_club" >Actualizar</button>
                    </form>
                    <!-- Formulario para eliminar -->
                    <form action="index.php?action=delete_club" method="post" class="form-botones" style="display:inline;"  onsubmit="return confirmDelete()">
                        <input type="hidden" name="codigo_club" value="<?= $rep['id'] ?>">
                        <button type="submit" id="boton-clubes2" name="action" value="delete_club" >Borrar</button>
                    </form>
                </td>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($listaRep)):?>
            <p>No se encontraron usuarios con ese nombre</p>
        <?php endif;?>
<!-- ================================================================================================================ -->
        <form action="index.php?action=search_repres" method="get" id="form_buscar_repres">
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
        <label id="label_id_rep" for="id_rep">Seleccione el representante que desea revisar.</label>
<!-- ====================================================================================================================== -->
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

        
    </div>

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

#fondo-repres{
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
#contenedor-general{
    width: 90%;
    display:flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin:2rem;
    background-color: #4A0D0D;
    border: #D4AF37 solid 1px;
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
h2{
    font-family:'Courier New', Courier, monospace;
    font-size: 2vw;
    color:white;
}
#form_buscar_repres{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    width:90%;
    margin-top:2rem;
   }
label{
    color:white;
    font-family:'Courier New', Courier, monospace;
   
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
#head-inser1, #head-inser2,#head-inser3,#head-inser4{
    background-color: #7A1F1F;
    font-family:'Courier New', Courier, monospace;
    font-size: 1vw;
}
#head-inser1, #head-inser2, #head-inser3, #head-inser4, #head-inser5, #head-inser6{
    background-color: #7A1F1F;
}
</style>
<!-- ============================================================================================================= -->
<style>
h1 {
    color: #7A1F1F;; /* Verde militar */
    font-family: 'calibri', sans-serif;
}

.table {
    width: 80%;
    background-color: white;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.table th {
    background-color: #7A1F1F;; /* Verde militar */
    color: white;
    border-radius: 7px;
}

.table th, .table td {
    text-align: center;
    padding: 0.3rem;
    font-size: 1rem;
}

#table-repre{
    border: 1px solid #ddd;
    width: 90%;
}

.btn-custom {
    background-color: #7A1F1F;;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border: none;
}

.btn-custom:hover {
    background-color: #3c421c;
}

button {
    background-color: #7A1F1F;;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    padding: 0.5rem 1.5rem;
    border: none;
}

button:hover {
    background-color: #3c421c;
}
input, select {
    padding: 0.5rem;
    font-size: 1.2rem;
    border-radius: 7px;
}
.form-select{
    width: 49%;
    font-size: 0.8rem;
    margin:0;
}
.btn-custom{
    width: 70%;
}
#div-botones{
    display: flex;
    flex-direction: row;
    justify-content:center;
    align-items: center;
    margin-top:3%;
    margin-bottom:1%;    
    width:90%;
    
    height: 2.5vw;
    padding:0;
}


.botones{  
        
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:'Courier New', Courier, monospace;
            font-size: 1vw;
            color:#4A0D0D;
           height:100%;
}
.for_up_club{
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
   
    width: 90%;
}
#div_up_club1, #div_up_club2, #div_up_club3, #div_up_club4{
    display:flex;
    flex-direction: column;
    justify-content:center;
    align-items: center;
    width: 90%;
    height: 30%;
}
th{
    background-color: #7A1F1F;
}
#label_id_rep{
    width: 90%;
}
  #boton-clubes1, #boton-clubes2{
        width: 3rem;
        border: #4A0D0D solid 1px;
        background-color: transparent;
        border-radius: 3px;
        font-size: 0.6rem;
        color:#4A0D0D;
        padding:0.3rem;
    }
    #head-repre{
        font-size: 0.8rem;
    }
</style>