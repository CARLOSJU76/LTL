<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Vehículos</title>
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/listar_clubes.css">
    <style>
         
    </style>
    
</head>
<body>

<div class="container mt-4" >
    <?php if(isset($arrayC) && count($arrayC)>0):?>
    <h2>Clubes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th id="head-inser1">Club</th>
                <th id="head-inser2">Representante</th>
                <th id="head-inser3">Documento</th>
                <th id="head-inser4">Fecha de Conformación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arrayC as $cl): ?>
            <tr>
                <td><?=$cl['nombreClub']?></td>
                <td><?=$cl['nombreR'] . ' ' . $cl['apellidoR']?></td>
                <td><?=$cl['documento']?></td>
                <td><?=$cl['fecha']?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?php elseif(isset($arrayC)):?>
            <p>No se encontraron usuarios con ese nombre</p>

        <?php endif;?>
    <!-- ================================================================================================================ -->

    <form action="index.php?action=search_club" method="get" id="form_buscar_club">
        <input type="hidden" name="action" value="search_club">
        
        
        
        <select name="codigo_club" id="codigo_club" class="form-select" required>
            <option value="">Elija el Club</option>
            <?php
                  include_once './controller/ClubController.php';
                  $clubCon= new ClubController();
                  $arrayClub= $clubCon->getNombreClubes();

                foreach($arrayClub as $cl1){
                    echo"<option value='" .htmlspecialchars($cl1['codigo'])."'>".
                        htmlspecialchars($cl1['nombreClub'])."
                        </option>";
                }
            ?>
        </select><br>
        <input type="submit" value="Buscar" id="buscar_club">        
    </form>
    <label for="codigo_club">Elija el Club que desea Analizar</label>
    <!-- ========================================================================================================= -->

    <div id="div-botones">
        <form action="index.php?action=update_club" method="get" class="form-botones">
            <input type="hidden" name="codigo_club" value="<?= $_GET['codigo_club'] ?? '' ?>">
            <button type="submit" name="action" value="update_club" class="botones">Actualizar datos</button>
        </form>
        <form action="index.php?action=delete_club" method="get" class="form-botones">
            <input type="hidden" name="codigo_club" value="<?= $_GET['codigo_club'] ?? '' ?>">
            <button type="submit" name="action" value="delete_club" class="botones">Quitar Club</button>
        </form><br>
        <form action="index.php?action=manage_club" method='get' enctype="multipart/form-data" class="form-botones">
                <button type="submit" name="action" value="club_manage" class="botones">Gestión de Clubes</button>
        </form>
        <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
        </form>
    </div>

</div>
</body>
</html>