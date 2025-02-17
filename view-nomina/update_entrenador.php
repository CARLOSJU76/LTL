<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Entrenador</title>
    
    
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="css/insert_represent.css">
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
        <form action="index.php?action=update_entrenador" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
            <input type="hidden" name="id_ent" value="<?= $_GET['id_ent'] ?? '' ?>">
        
    <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
        <thead>
            <tr>
                <th colspan="2" class="text-center" id="head-inser_club">Edición de datos Entrenadores</th>
            </tr>
        </thead>
        <tbody>
            <!-- Segunda fila: Campos del formulario -->
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre del Dirigente" class="form-control" value="<?= $data[0]['nombreE'] ?? '' ?>"required>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="apellido" id="apellido" placeholder="Apellidos" class="form-control" value="<?= $data[0]['apellidoE'] ?? '' ?>"required>
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
                                        $selected = ($tipoD['tipo_docum'] == $data[0]['tipodoc']) ? 'selected' : '';
                                        echo "<option value='".htmlspecialchars($tipoD['codigo'])."' $selected>"
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
                        <input type="text" name="num_docum" id="num_docum" placeholder="Número de documento" class="form-control" value="<?= $data[0]['id'] ?? '' ?>" required >
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
                                        $selected = ($gen['genero'] == $data[0]['genero']) ? 'selected' : '';
                                        echo "<option value='".htmlspecialchars($gen['codigo'])."' $selected>"
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
                            <input type="date" value="<?= $data[0]['fecha'] ?? '' ?>" id="fecha" name="fecha" placeholder="fecha de nacimiento" class="form-control"  required><br>
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
                        <input type="text" value="<?= $data[0]['direccion'] ?? '' ?>" name="direccion" id="direccion" placeholder="Dirección de Residencia" class="form-control" required>
                    </div>
                </td>
            </tr>
            <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" value="<?= $data[0]['telefono'] ?? '' ?>" name="telefono" id="telefono" placeholder="Digite el teléfono" class="form-control" required>
                            </div>
                        </td>
                    </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <input type="email"  name="email" id="email" placeholder="Correo Electrónico" class="form-control" value="<?= $data[0]['email'] ?? '' ?>"required>
                    </div>
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
                                    $selected = ($club['nombreClub'] == $data[0]['club']) ? 'selected' : '';
                                    echo "<option value='".htmlspecialchars($club['id'])."' $selected>"
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
                    <img src="fotos/<?= $data[0]['foto'] ?? '' ?>" width="100px" alt="Foto actual"><br>
                    <input type="file" name="foto" placeholder="Elija una imagen"><br>
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
            <form action="index.php?action=club_manage" method="get" class="form-botones">
                <button type="submit" name="action" value="club_manage" class="botones">Gestión de Clubes</button>
            </form>
            <form action="index.php?action=principal" method="get" class="form-botones">
                <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
            </form>
        </div>
        
    </div>

    <script src="JS/co-dpt-ci.js"></script>

</body>
</html>
