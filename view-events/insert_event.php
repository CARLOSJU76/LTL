
    <!-- =============================================================================================================================== -->
    <div class="container" id="container_general">
        <div id="div-h2"><h3>LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=insert_events" method="post" id="formulario_insereventos">
            <h4 colspan="2" class="text-center" id="titulo_insereventos">Formulario Inserción de Eventos</h4>
                <table class="table" id="tabla_inser_eventos">
                    <tbody>
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
                                                echo "<option value='".htmlspecialchars($evento['codigo'])."'>"
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
                                <input type="text" name="nombreEv" id="nombreEv" placeholder="Nombre del evento" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" id="id-fecha">
                                <input type="date" id="fechaEv" name="fechaEv" max="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento" class="form-control" required>
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
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Guardar Datos</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        
   </div>

<style>
    #container_general{
        overflow: auto;
        width: 100%;

        background-image: url('./IMG/LTL/luchafemenil.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;
    }
    #formulario_insereventos{
        background-color: #4A0D0D;
        width: 60%;
        padding:1rem;
        border: gold 1px solid;
        border-radius: 4px;
    }
    #titulo_insereventos{
        background-color: transparent;
        color:gold;
    }
    #tabla_inser_eventos{
        background-color: transparent;
        padding:0;
    }
    
</style>
<link rel="stylesheet" href="./CSS/club_manage.css">
<link rel="stylesheet" href="./CSS/insert_represent.css">
<link rel="stylesheet" href="./CSS/desp_Ubicacion.css">
<link rel="stylesheet" href="./CSS/inscrip_depor.css">
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="JS/co-dpt-ci.js"></script>

