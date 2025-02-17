<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Representante legal de Club</title>
    <!-- Incluir Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="css/insert_represent.css">
</head>
<body>
<!-- ================================================================================================================================= -->

<div class="container mt-4">
    <div id="div-h2"><h3>LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=update_repre" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
            <input type="hidden" name="id_rep" value="<?= $_GET['id_rep'] ?? '' ?>">
        
    <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
        <thead>
            <tr>
                <th colspan="2" class="text-center" id="head-inser_club">Edición de datos Dirigente</th>
            </tr>
        </thead>
        <tbody>
            <!-- Segunda fila: Campos del formulario -->
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre del Dirigente" class="form-control" value="<?= $repreData[0]['nombreR'] ?? '' ?>"required>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="apellido" id="apellido" placeholder="Apellidos" class="form-control" value="<?= $repreData[0]['apellidoR'] ?? '' ?>"required>
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
                                        $selected = ($tipoD['codigo'] == $repreData[0]['codigo_rep']) ? 'selected' : '';
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
                        <input type="text" name="num_docum" id="num_docum" placeholder="Número de documento" class="form-control" value="<?= $repreData[0]['numdoc'] ?? '' ?>" required >
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
                                        $selected = ($gen['codigo'] == $repreData[0]['cod_genero']) ? 'selected' : '';
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
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Correo Electrónico" class="form-control" value="<?= $repreData[0]['email'] ?? '' ?>"required>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="telefono" id="telefono" placeholder="Número telefónico" class="form-control" value="<?= $repreData[0]['telefono'] ?? '' ?>"required>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                    <img src="fotos/<?= $repreData[0]['foto'] ?? '' ?>" width="100px" alt="Foto actual"><br>
                    <input type="file" name="foto" placeholder="Elija una imagen"><br>
                </div>
                </td>
            </tr>
            <!-- Tercera fila: Botón de submit -->
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

</body>
</html>
