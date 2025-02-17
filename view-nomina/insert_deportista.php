<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción de Deportistas</title>

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
        <form action="index.php?action=insert_deportista" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
        
            <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Formulario Inscripción de  Deportistas</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- Segunda fila: Campos del formulario -->
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre del Deportista" class="form-control" required>
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
                                <input type="date" id="fecha" name="fecha" placeholder="fecha de nacimiento" class="form-control" required>
                                <label for="fecha" id="label-fecha">Seleccione la fecha de nacimiento</label>
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
                                <input type="text" name="telefono" id="telefono" placeholder="Digite el teléfono" class="form-control" required>
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
                        <!-- Tercera fila: Botón de submit -->
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
                                <select name="club" id="club" class="form-select" required>
                                    <option value="">Nombre del Club</option>
                                        <?php 
                                       
                                            $clubes1= $genero1->listClubes();
                                            foreach($clubes1 as $club){
                                            echo "<option value='".htmlspecialchars($club['id'])."'>"
                                            .htmlspecialchars($club['nombreClub'])."</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                <td>
                    <div class="form-group">
                        <input type="file" name="foto" id="foto" class="form-control" required>
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
            <form action="index.php?action=sport_manage" method="get" class="form-botones">
                <button type="submit" name="action" value="sport_manage" class="botones">Gestión de Deportistas</button>
            </form>
            <form action="index.php?action=principal" method="get" class="form-botones">
                <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
            </form>
        </div>
        
   </div>

<script src="JS/co-dpt-ci.js"></script>

</body>
</html>
