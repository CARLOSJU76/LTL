<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Eventos</title>
    
    
    <link rel="stylesheet" href="./CSS/club_manage.css">
    <link rel="stylesheet" href="CSS/insert_represent.css">
    <script src="JS/jquery-3.7.1.min.js"></script>
    <style>
        body{
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
    </style>
    
</head>
<body>
<!-- ================================================================================================================================= -->



<div class="container mt-4">
    <div id="div-h2"><h3>LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=update_event" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
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
<!-- ================================================================================================================================================================== -->
<div id="div-botones">
            <form action="index.php?action=event_manage" method="get" class="form-botones">
                <button type="submit" name="action" value="event_manage" class="botones">Gestión de Eventos</button>
            </form>
            <form action="index.php?action=principal" method="get" class="form-botones">
                <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
            </form>
        </div>
        
    </div>

    <script src="JS/co-dpt-ci.js"></script>

</body>
</html>
