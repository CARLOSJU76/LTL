<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Representante legal de Club</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/club_manage.css">
</head>
<body>
    <style>
        .form-control, .form-select{
            width: 80%;
            margin-bottom: 3%;
            text-justify: center;
            font-family:'Courier New', Courier, monospace
        }
        #h1_up_club{
        color:white;
        font-family:'Courier New', Courier, monospace
        }
        label{
            color:white;
            font-family:'Courier New', Courier, monospace
        }
        #boton_submit{
            grid-row:6/7;
            grid-column: 3/7;
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:'Courier New', Courier, monospace;
            font-size: 2vw;
            color:#4A0D0D;
            ;
}
    </style>
    <div class="container mt-4" >
        <h1 class="text-center mb-4" id="h1_up_club">Actualiza Datos de Representante</h1>
        <form action="index.php?action=update_repre" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_rep" value="<?= $_GET['id_rep'] ?? '' ?>">
            
            <div class="mb-3" id="div_up_club1">
                <label for="nombre" class="form-label">Actualice los nombres:</label>
                <input type="text" name="nombre" value="<?= $repreData[0]['nombreR'] ?? '' ?>" class="form-control" placeholder="Nombre del Representante">
            </div>
            <div class="mb-3" id="div_up_club2">
                <label for="apellido" class="form-label">Actualice los apellidos:</label>
                <input type="text" name="apellido" value="<?= $repreData[0]['apellidoR'] ?? '' ?>" class="form-control" placeholder="Nombre del Representante">
            </div>
            <!-- <?=$rep['nombreR'] . ' ' . $rep['apellidoR']?> -->
            <div class="mb-3" id="div_up_club3">
                <label for="codigo_td" class="form-label">Actualice tipo documento:</label>
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
            <div class="mb-3" id="div_up_club4">
                <label for="num_docum" class="form-label">Actualice Número de Documento:</label>
                <input type="text" name="num_docum" value="<?= $repreData[0]['numdoc'] ?? '' ?>" class="form-control" placeholder="Nombre del Representante">
            </div>

            <div class="mb-3" id="div_up_club5">
                
                <label for="genero" class="form-label">Actualice Género</label>
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

            <div class="mb-3" id="div_up_club6">
                <label for="fecha" class="form-label">Actualice Correo electrónico</label>
                <input type="email" name="email" value="<?= $repreData[0]['email'] ?? '' ?>" class="form-control" placeholder="Modelo">
            </div>        

            <button type="submit" class="btn btn-custom" id="boton_submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
