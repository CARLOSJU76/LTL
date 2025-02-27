<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserción de Eventos</title>

    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="./CSS/club_manage.css">
    <link rel="stylesheet" href="./CSS/insert_represent.css">
    <link rel="stylesheet" href="./CSS/desp_Ubicacion.css">
    <link rel="stylesheet" href="./CSS/inscrip_depor.css">
    <script src="JS/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
     <style>
        #container_general{
            overflow: auto;
        }
    
        body{
            background-image: url('./IMG/LTL/luchafemenil.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
     </style>
    
</head>
<body>
    <!-- =============================================================================================================================== -->
    <div class="container" id="container_general">
        <div id="div-h2"><h3>LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=insert_programados" method="post" id="formulario_inserclubes">
        
            <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Formulario Programación de Eventos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="tipoEv" id="tipoEv" class="form-select" required>
                                    <option value="">Elija tipo de Evento</option>
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
                                <input type="date" id="fechaEv" name="fechaEv" min="<?php echo date('Y-m-d'); ?>"  placeholder="fecha del evento" class="form-control" required>
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
<script>
    document.getElementById("fechaEv").setAttribute("min", new Date().toISOString().split("T")[0]);
</script>

</body>
</html>
