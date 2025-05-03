
<?php
session_start();

// convertir a array si es string

    $perfilArray = str_split($_SESSION['perfil']);

// verificar si el perfil (posición 2) es permitido
if (!isset($perfilArray[4]) || $perfilArray[4] != 1) {
    header('Location: views/no_autorizado.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cargar Estados Financieros</title>
</head>
    <style>
        body{
            display:flex;
            justify-content:center;
           
        }
        #contenedor_estados, #formulario {
            display:flex;
            flex-direction: column;
            align-items:center;
            background-color: #4A0D0D;
            color:gold;            
            width: 40%;
        }
        .botones{
            display:flex;
            align-items:center;
            background-color:transparent;
            border: gold solid 1px;
            color:gold;
            font-family: 'Courier New', Courier, monospace;
            border-radius:5px;
            margin:4%;
            width: 80%;
            aspect-ratio:5/1;
            justify-content:center;
            padding:1%;
            
      cursor: pointer;
        }
        input[type="file"] {
      display: none;
    }
    </style>
<body>

    <div id="contenedor_estados">
    <h3 style="font-family:'Courier New', Courier, monospace;">Cargar Estados Financieros</h3>
    <form action="index.php?action=cargar_estados" method="post" enctype="multipart/form-data" id="formulario">
        <input type="number" name="nualidad" min="2024" placeholder="AÑO">
        <label for="boton-pdf" id="label-input" class="botones">Elige el archivo</label>
        <input type="file" name="estados_pdf" accept=".pdf" id="boton-pdf">
        <input type="submit" name="submit" value="Subir PDF" class="botones">
    </form>

    </div>

    <script>
    // Seleccionar los elementos
    const inputFile = document.getElementById('boton-pdf');
    const labelInput = document.getElementById('label-input');
    
    // Agregar un evento de cambio (cuando se selecciona un archivo)
    inputFile.addEventListener('change', function() {
        const fileName = inputFile.files[0] ? inputFile.files[0].name : 'Ningún archivo seleccionado';
        labelInput.textContent = fileName;  // Cambiar el texto del label para mostrar el nombre del archivo
    });
</script>
    
</body>
</html>
