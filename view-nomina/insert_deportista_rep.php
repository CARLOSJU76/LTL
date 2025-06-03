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
    
    
    
<!-- ======================================================================= -->
    <div id="fondo-repre">
    <div class="container mt-4">
    <div id="div-h2"><h3 style="color:#D4AF37;">LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=insert_deportista_Rep" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
            <table class="table" id="tabla_inser_clubes">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Formulario registro de Deportistas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre del deportista" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="apellido" id="apellido" placeholder="Apellidos" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="codigo_td" id="codigo_td" class="form-select" required>
                                    <option value="">Elija el Tipo de documento</option>
                                        <?php 
                                            include_once('./controller/ClubController.php');
                                            $td1 = new ClubController();
                                            $arrayTd = $td1->getTd();
                                            foreach($arrayTd as $tipoD){
                                                echo "<option value='".htmlspecialchars($tipoD['codigo'])."'>"
                                                .htmlspecialchars($tipoD['tipo_docum'])."</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="num_docum" id="num_docum" placeholder="Número de documento" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="genero" id="genero" class="form-select" required>
                                    <option value="">Elija el género</option>
                                        <?php 
                                            $genero1 = new ClubController();
                                            $arrayge1 = $genero1->getGenero();
                                            foreach($arrayge1 as $gen){
                                                echo "<option value='".htmlspecialchars($gen['codigo'])."'>"
                                                .htmlspecialchars($gen['genero'])."</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" id="id-fecha">
                                <input type="date" id="fecha" name="fecha" placeholder="fecha de nacimiento" class="form-control" required><br>
                                <label for="fecha" id="label-fecha" style="color: #837060; font-style:italic; font-size:0.7rem;">Seleccione la fecha de nacimiento</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
<!-- ========================================================================================================================================== -->
                        <td id="td-ubicacion">
                            <div class="menu">
<!-- ========================================================================================================================================== -->
                                <div id="uno">
                                    <select id="pais" id="select-ubi1" class="form-select" name="pais" required>
                                        <option value="">Elige país</option>
                                        <!-- Aquí se llenarán los países desde la base de datos -->
                                    </select>
                                </div>
<!-- ========================================================================================================================================== -->
                                <div id="dos">
                                    <select id="departamento" id="select-ubi2" class="form-select" name="departamento" style="display:none;" required>
                                        <option value="">Elije departamento</option>
                                        <!-- Aquí se llenarán los departamentos según el país -->
                                    </select>
                                </div>
<!-- ========================================================================================================================================== -->
                                <div id="tres">
                                    <select id="ciudad" name="ciudad" id="select-ubi3" class="form-select" style="display:none;" required>
                                        <option value="">Elije ciudad</option>
                                        <!-- Aquí se llenarán las ciudades según el departamento -->
                                    </select>
                                </div>
<!-- ========================================================================================================================================== -->
                            </div>
                        </td>
<!-- ========================================================================================================================================== -->
                    </tr>
                     <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="direccion" id="direccion" placeholder="Dirección de Residencia" class="form-control" required>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Correo Electrónico" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="telefono" id="telefono" placeholder="Digite el teléfono" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td>
                        <select name="modalidad" id="modalidad" class="form-select" required>
                                    <option value="">Elija Modalidad</option>
                                        <?php 
                                            include_once 'controller/ElementosController.php';
                                            $elemento1= new ElementosController();
                                            $modalidades= $elemento1->getModalidades();
                                            foreach($modalidades as $mod){
                                            echo "<option value='".htmlspecialchars($mod['id'])."'>"
                                            .htmlspecialchars($mod['modalidad'])."</option>";
                                            }
                                        ?>
                                </select>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <div class="form-group">
                                <input type="hidden" name="club" id="club" class="form-select" value="<?= htmlspecialchars($codigo_club) ?>">
                            </div>
                        </td>
                     </tr>
<!-- ===========================Esta es la parte de la Foto========================================================================================= -->
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="file" name="foto" id="foto" class="form-control" required>
                            </div>
                        </td>
                    </tr>
<!-- ================================================================================================================== -->
            <!-- Tercera fila: Botón de submit -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Guardar Datos</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<!-- ================================================================================================================= -->
<link rel="stylesheet" href="./css/club_manage.css">
<style>
    #fondo-repre{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-image: url('./IMG/LTL/dark-mat.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;
        }
 </style>
 <!-- ========================================insert_represent=============================================================== -->
  <style>
.container{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 50%;
    background-color: #4A0D0D;
    border: #D4AF37 solid 1px;
    margin:2rem;
}
#tabla_inser_clubes{
    background-color: whitesmoke;
    width:100%;
    border:#4A0D0D solid 1px;
}
#formulario_inserclubes{
    margin-top: 0;
    width: 90%;
    border:none;
   
}
#boton_submit{
    grid-row:6/7;
    grid-column: 3/7;
    background: linear-gradient(to bottom, #ffd700, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1.2vw;
   font-weight: bold;
    color:#4A0D0D;
}
#head-inser_club{
    background-color: #4A0D0D;
    color:#D4AF37;
    font-weight: 100;
    font-size:1.2rem;
}
.form-control, .form-select{
    width: 80%;
    font-size:0.8rem;
    padding: 0.3rem;
    margin-bottom:0;
    text-justify: center;
    font-family:'Courier New', Courier, monospace;
    border:#D4AF37 solid 1px;
}
h3{
    margin-bottom: 0;
    color:gold;
    font-family:'Courier New', Courier, monospace;
    font-style: italic;
    padding:0;
 }
 #div-h2{
    width: 100%;
    display:flex;
    justify-content: start;
 }
 #foto{
    background-color: transparent;
    border: #D4AF37 solid 1px;
    color:#4A0D0D;
    border-radius: 3px;
 }
  </style>
<!-- ================================================================================================================ -->
<script src="JS/jquery-3.7.1.min.js"></script>
<script src="JS/co-dpt-ci.js"></script>
