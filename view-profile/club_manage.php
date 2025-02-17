<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clubes</title>

    <!-- Incluir Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css"  integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/club_manage.css">
    <link rel="stylesheet" href="css/insert_club.css">
    <style>
        body{
            background-image: url('./IMG/LTL/renteria.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
        #head-manage-club{
            background-color: #7A1F1F;
            font-size: 2vw;
            font-family:'Courier New', Courier, monospace;

        }
    
    </style>
    
</head>
<body>
<!-- =========================================================================================================================== -->
<div class="container" >
        <div id="div-h2"><h3>LTL Website</h3></div>
        <!-- Formulario dentro de una tabla centrada -->
       
        <form action="index.php" method="GET" id="formulario_inserclubes">
        
            <table class="table" id="tabla_inser_clubes">
            <!-- Primera fila: Encabezado -->
                <thead >
                    <tr >
                        <th colspan="2" class="text-center" id="head-manage-club">Gestión de Clubes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="action" id="repesentante" class="form-select form-select-lg" onchange="this.form.submit()">
                                    <option value="" disabled selected>Gestión de Clubes</option> <!-- Opción predeterminada -->
                                    <option value="insert_Club">Incluir Club</option>
                                    <option value="insert_representante">Incluir representante</option>
                                    <option value="list_club">Consultar Clubes</option>                    
                                    <option value="list_repres">Consultar Representantes</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<!-- ============================================================================================================================ -->
        <div id="div-botones">
                <!-- <form action="index.php?action=club_manage" method="get" class="form-botones">
                    <button type="submit" name="action" value="club_manage" class="botones">Gestión de Clubes</button>
                </form> -->
                <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
                </form>
        </div>

<!-- ============================================================================================================================= -->


    <!-- Incluir Bootstrap JS y Popper (para componentes interactivos) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb1gU5CHyXc7D6T2t5fSfaFz0GvL" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Yz0u0g3P69VJ3xJkpQig2hFfoIF61h1iRIyR38uL9a5NwGo" crossorigin="anonymous"></script> -->

</body>
</html>
