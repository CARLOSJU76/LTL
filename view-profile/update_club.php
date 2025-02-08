<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Clubes</title>
    <!-- Incluir Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/insert_club.css">
</head>
<body>
    <!-- ======================================================================================================================= -->
    <div class="container mt-4" >
        <div id="div-h2"><h3>LTL Website</h3></div>
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=update_club" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
            <input type="hidden" name="codigo_club" value="<?= $_GET['codigo_club'] ?? '' ?>">
        
            <table class="table" id="tabla_inser_clubes">
            <!-- Primera fila: Encabezado -->
                <thead >
                    <tr >
                        <th colspan="2" class="text-center" id="head-inser_club">Edición datos de Club</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Segunda fila: Campos del formulario -->
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="nombre_club" id="nombre_club" placeholder="Nombre del Club" class="form-control" value="<?= $clubData[0]['nombreClub'] ?? '' ?>" required >
                            </div>
                        </td>
                    </tr>
           
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="id_representante" id="id_representante" class="form-select" required>
                                    <option value=""> Actualice el Representante</option>
                                    <?php
                                    include_once('./controller/ClubController.php');
                                    $repre = new ClubController();
                                    $arrayRepre= $repre->getRepresentante();

                                    foreach ($arrayRepre as $repre1) {
                            // Verificamos si el id del representante coincide con el id del representante actual en el club
                                        $selected = ($repre1['id'] == $clubData[0]['id']) ? 'selected' : '';
                        
                                        echo "<option value='" . htmlspecialchars($repre1['id']) . "' $selected>" . 
                                        htmlspecialchars($repre1['nombres']) . " " . 
                                        htmlspecialchars($repre1['apellidos']) . 
                                        "</option>";
                                    }    
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="date" id="fecha_conformacion" name="fecha" placeholder="Fecha de conformacion"  class="form-control" value="<?= $clubData[0]['fecha'] ?? '' ?>">
                            </div>
                        </td>
                    </tr>
           
            
                    <!-- Tercera fila: Botón de submit -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Actualizar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div id="div-botones">
                <form action="index.php?action=club_manage" method="get" class="form-botones">
                    <button type="submit" name="action" value="club_manage" class="botones">Gestión de Clubes</button>
                </form>
                <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
                </form>
        </div>    
    </div>
    <!-- ================================================================================================================================== -->
</body>
</html>
