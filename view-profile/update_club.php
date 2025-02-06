<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Clubes</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/update_club.css">
</head>
<body>
    <style>
       
    </style>
    <div class="container mt-4" >
        <h1 class="text-center mb-4" id="h1_up_club">Editando los Datos del Club</h1>
        <form action="index.php?action=update_club" method="post" enctype="multipart/form-data" class="for_up_club">
            <input type="hidden" name="codigo_club" value="<?= $_GET['codigo_club'] ?? '' ?>">
            
            <div class="mb-3" id="div_up_club1">
                <label for="nombre_club" class="form-label">Actualice el nombre:</label>
                <input type="text" name="nombre_club" value="<?= $clubData[0]['nombreClub'] ?? '' ?>" class="form-control" placeholder="Placa">
            </div>
            
            <div class="mb-3" id="div_up_club2">
                <label for="id_representante" class="form-label">Actualice el representante</label>
                <select name="id_representante" class="form-select">
                    <option value="" aria-placeholder="actualice el representante"></option>
                    <?php
                        include_once('./controllers/ClubController.php');
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

            <div class="mb-3" id="div_up_club3">
                <label for="fecha" class="form-label">Actualización de fecha</label>
                <input type="date" name="fecha" value="<?= $clubData[0]['fecha'] ?? '' ?>" class="form-control" placeholder="Modelo">
            </div>        

            <button type="submit" class="btn btn-custom" id="boton_submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
