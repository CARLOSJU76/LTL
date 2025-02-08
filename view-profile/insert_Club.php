<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserción de Clubes</title>

    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.min.css"  integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/insert_club.css">
    <style>
       
    </style>
    
</head>
<body>

<!-- =================================================================================================================================== -->
    <div class="container mt-4" >
        <div id="div-h2"><h3>LTL Website</h3></div>
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=insert_Club" method="post" id="formulario_inserclubes">
        
            <table class="table" id="tabla_inser_clubes">
            <!-- Primera fila: Encabezado -->
                <thead >
                    <tr >
                        <th colspan="2" class="text-center" id="head-inser_club">Formulario inserción de clubes</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Segunda fila: Campos del formulario -->
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="nombre_club" id="nombre_club" placeholder="Nombre del Club" class="form-control" required>
                            </div>
                        </td>
                    </tr>
           
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="representante" id="representante" class="form-select" required>
                                    <option value="">Elija el Representante</option>
                                    <?php 
                                    include_once('./controller/ClubController.php');
                                    $rep1 = new ClubController();
                                    $arrayRep = $rep1->getRepresentante();
                                    foreach($arrayRep as $repre){
                                        echo "<option value='".htmlspecialchars($repre['id'] ?? '')."'>"
                                        .htmlspecialchars($repre['nombres'] ?? '')." ".htmlspecialchars($repre['apellidos'] ?? '')."</option>";
                                    }
                                
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="date" id="fecha_conformacion" name="fecha_conformacion" class="form-control" required>
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
        <div id="div-botones">
                <form action="index.php?action=club_manage" method="get" class="form-botones">
                    <button type="submit" name="action" value="club_manage" class="botones">Gestión de Clubes</button>
                </form>
                <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
                </form>
        </div>

        
    </div>
    <!-- ============================================================================================================================== -->

    <!-- Incluir Bootstrap JS y Popper (para componentes interactivos) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb1gU5CHyXc7D6T2t5fSfaFz0GvL" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Yz0u0g3P69VJ3xJkpQig2hFfoIF61h1iRIyR38uL9a5NwGo" crossorigin="anonymous"></script> -->

</body>
</html>
