
<div id="fondo-representante">
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
.container {
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color:#4A0D0D;
    border-radius: 4px;
    border: 1px solid  #D4AF37;/*Dorado*/
    width: 80%;
    margin:2rem;
}
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
    padding: 15px;
    font-size: 1rem;
}

.table-bordered {
    border: 1px solid #ddd;
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
.form-control, .form-select{
    width: 80%;
    font-size: small;
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
</style>