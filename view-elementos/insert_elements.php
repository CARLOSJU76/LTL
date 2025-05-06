
    <!-- =============================================================================================================================== -->
<div id="fondo-elementos">
    <div class="container" id="container_general">
        <div id="div-h2"><h3>LTL Website</h3></div>
<!-- ===================================FORMULARIO DE INSERCIÓN DE CATEGORÍA POR EDAD============================================================================================= -->
        <form action="index.php?action=insert_categoriaxEdad" method="post" id="formulario_inserclubes" class="for-elementos">

            <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Incluya Categoría de Edad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="categoriaxEdad" id="nombreEv" placeholder="Límite de Categoría de Edad" class="form-control" required>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Incluir Categoría de Edad</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

<!-- ======================================================================================================================================== -->
<!-- ===================================FORMULARIO DE INSERCIÓN MODALIDAD============================================================================================= -->
        <form action="index.php?action=insert_modalidad" method="post" id="formulario_inserclubes" class="for-elementos">

            <table class="table" id="tabla_inser_clubes">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Incluya Modalidad</th>
                    </tr>
                </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="modalidad" id="odalidad" placeholder="Nombre de la Modalidad" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Incluir Modalidad</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- ======================================================================================================================================== -->
<!-- ===================================FORMULARIO DE INSERCIÓN DIVISIÓN DE PESO============================================================================================= -->
        <form action="index.php?action=insert_divisionxPeso" method="post" id="formulario_inserclubes" class="for-elementos">
            <table class="table" id="tabla_inser_clubes">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Incluya División de Peso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="id_ce" id="select_categoriaxEdad" class="form-select" required>
                                    <option value="">Elija la categoría por Edad</option>
                                        <?php 
                                          include_once 'controller/ElementosController.php';
                                          $elemento1 = new ElementosController();
                                        $categorias1 = $elemento1->getCategoria();
                                        foreach($categorias1 as $cat){
                                          
                                            echo "<option value='".htmlspecialchars($cat['id'])."' >"
                                            .htmlspecialchars($cat['categoria'])."</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="id_mod" id="select_modalidad" class="form-select" required>
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
                                <input type="num" name="divisionxPeso" id="nombreEv" placeholder="Límite de la División de Peso en Kilogramos." class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Incluir División de Peso </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<!-- ================================================================================================== -->

<link rel="stylesheet" href="./CSS/club_manage.css">
<link rel="stylesheet" href="./CSS/insert_represent.css">
<link rel="stylesheet" href="./CSS/desp_Ubicacion.css">
<link rel="stylesheet" href="./CSS/inscrip_depor.css">
<script src="JS/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<style>
    #container_general{
        overflow: auto;
        margin:2rem;
        background-color: #4A0D0D;
        border: 2px solid #D4AF37;
        border-radius: 3px;
    }

#fondo-elementos{
    background-image: url('./IMG/LTL/luchafemenil.jpg');
    background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
    background-position: center center; /* Centra la imagen */
    background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
    background-repeat: no-repeat;  
    
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.for-elementos{
    margin-bottom: 1rem;
}
</style>
