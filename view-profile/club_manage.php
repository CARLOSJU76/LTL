<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clubes</title>

    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/club_manage.css">
    <style>
        #contenedor, #automovil{
            border: 3px solid white ;
            font-size: 1.2rem;
            padding: 0.5rem;
            border-radius: 7px;            
        }
        #automovil{
            border: 3px solid #4b5320;
        }
       
    </style>
    
</head>
<body>
<h2 class="text-center mb-4">Gestión de Clubes</h2>

    <div class="container mt-4" id="contenedor">
        

        <!-- Formulario -->
        <form action="index.php" method="GET" id="formulario">
            <div class="mb-3">
                <select name="action" id="automovil" class="form-select form-select-lg" onchange="this.form.submit()">
                    <option value="" disabled selected>Gestión de Clubes</option> <!-- Opción predeterminada -->
                    <option value="insert_Club">Incluir Club</option>
                    <option value="insert_representante">Incluir representante</option>
                    <option value="list_club">Consultar Clubes</option>                    
                    <option value="list_repres">Consultar Representantes</option>
                                      
                    
                </select>
            </div>
        </form>
    </div>

    <!-- Incluir Bootstrap JS y Popper (para componentes interactivos) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb1gU5CHyXc7D6T2t5fSfaFz0GvL" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Yz0u0g3P69VJ3xJkpQig2hFfoIF61h1iRIyR38uL9a5NwGo" crossorigin="anonymous"></script> -->

</body>
</html>
