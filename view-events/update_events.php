
   
    

<!-- <?php var_dump($data); ?> -->
<!-- ================================================================================================================================= -->
<div class="container mt-4" id="fondo">
    <div id="div-h2"><h3>LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
    <form action="index.php?action=update_event" method="post" id="formulario-update" enctype="multipart/form-data">
            <input type="hidden" name="id_evento" value="<?= $_GET['id_evento'] ?? '' ?>">
        
        <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
            <thead>
                <tr>
                    <th colspan="2" class="text-center" id="head-inser_club">Edición de Eventos</th>
                </tr>
            </thead>
            <tbody>
<!-- ========================================TIPO DE EVENTO==================================================================== -->
                <tr>
                    <td>
                        <div class="form-group">
                            <select name="tipoEv" id="tipoEv" class="form-select" required>
                                <option value="">Elija el Tipo de Competición</option>
                                    <?php 
                                        include_once('./controller/ElementosController.php');
                                            $elemento1 = new ElementosController();
                                            $eventos1 = $elemento1->getTipoEvento();
                                            foreach($eventos1 as  $evento){
                                                $selected = ($evento['tipo_evento'] == $data[0]['tipoEv']) ? 'selected' : '';
                                                echo "<option value='".htmlspecialchars($evento['codigo'])."' $selected>"
                                                .htmlspecialchars($evento['tipo_evento'])."</option>";
                                            }
                                    ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" name="nombreEv" id="nombreEv" placeholder="Nombre del evento" class="form-control" value="<?= $data[0]['nombreEv'] ?? '' ?>" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group" id="id-fecha">
                            <input type="date" id="fechaEv" name="fechaEv" placeholder="fecha del evento" class="form-control" value="<?= $data[0]['fechaEv'] ?? '' ?>"  required><br>
                            <label for="fechaEv" id="label-fecha">Fije fecha del Evento</label>
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
                </tr>
                <tr>    
                    <td>
                        <div class="form-group">
                            <select name="categoriaxEdad" id="categoriaxEdad" class="form-select" required>
                                    <option value="">Elija la categoría por Edad</option>
                                        <?php 
                                        
                                         include_once('./controller/ElementosController.php');
                                        $elemento1 = new ElementosController();
                                        $categorias1 = $elemento1->getCategoria();
                                        foreach($categorias1 as $cat){
                                            echo "<option value='".htmlspecialchars($cat['id'])."'>"
                                            .htmlspecialchars($cat['categoria'])."</option>";
                                        }
                                        ?>
                            </select>
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
      
            <button type="submit" class="btn btn-custom" id="boton_submit">Guardar Datos</button>
        
                
    </form>
</div>
<!-- ============================================================================================================== -->
<link rel="stylesheet" href="./CSS/club_manage.css">
<link rel="stylesheet" href="CSS/insert_represent.css">
<script src="JS/jquery-3.7.1.min.js"></script>
<style>
    #fondo{
        width: 100%;
        background-image: url('./IMG/LTL/mat.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;
        }
    #formulario-update{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #4A0D0D;
        width: 60%;
        padding:2rem;
        border: 1px solid #D4AF37 ;
        border-radius: 3px;
    }
    #boton_submit{
        width: 40%;
        margin: 1rem;
    }
</style>

<script src="JS/co-dpt-ci.js"></script>

