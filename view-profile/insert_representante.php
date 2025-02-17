<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserción de Representantes de Club</title>

    <!-- Incluir Bootstrap CSS -->
 
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/insert_represent.css">
    <style>
    
        body{
            background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }

    </style>
    
    
</head>
<body>
    <div class="container mt-4">
    <div id="div-h2"><h3>LTL Website</h3></div>
       
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=insert_representante" method="post" id="formulario_inserclubes" enctype="multipart/form-data">
        
    <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
        <thead>
            <tr>
                <th colspan="2" class="text-center" id="head-inser_club">Formulario inserción Dirigentes</th>
            </tr>
        </thead>
        <tbody>
            <!-- Segunda fila: Campos del formulario -->
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre del dirigente" class="form-control" required>
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
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Correo Electrónico" class="form-control" required>
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
<!-- ===========================Esta es la parte de la Foto========================================================================================= -->
            <tr>
                <td>
                    <div class="form-group">
                        <input type="file" name="foto" id="foto" class="form-control" required>
                    </div>
                </td>
            </tr>
<!-- ================================================================================================================== -->
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
            <form action="index.php?action=principal" method="get" class="form-botones">
                <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
            </form>
        </div>
        
    </div>

    <!-- Incluir Bootstrap JS y Popper (para componentes interactivos) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb1gU5CHyXc7D6T2t5fSfaFz0GvL" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Yz0u0g3P69VJ3xJkpQig2hFfoIF61h1iRIyR38uL9a5NwGo" crossorigin="anonymous"></script> -->

</body>
</html>
