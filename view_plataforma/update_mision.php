<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Misión</title>
    <style>
        body{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #contenedor, .formulario{
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 40%;
            aspect-ratio: 1/1;
            background-color:#7A1F1F;
        }
        #formulario, #formulario1{
            width: 80%;
            aspect-ratio: 4/1;
        }
        textarea{
            width: 90%;
            aspect-ratio: 1/1;
            font-size: italic;
        }
        .form-botones{
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:italic;
            font-size: 1.2vw;
            font-weight: bold;
            color:#4A0D0D;
            width:30%;
            margin:2%;
        }
        h2{
            color:white;
            font-family: italic;
            font-size: 1.5vw;
        }

    </style>
</head>
<body>
    <div id="contenedor">
        <h2>Actualizace la Misión:</h2>
        <form action="index.php?action=update_mision" method="post" class="formulario" id="formulario"onsubmit="validarFormulario(event)">
            <textarea name="nueva_mision" placeholder="Actualice aquí la misión" id="text_mision">
            </textarea>
            <input type="submit" value="Actualizar Misión" class="form-botones">

        </form>
        <form action="index.php?action=club_principal" method="get" class="formulario" id="formulario1" >
                    <button type="submit" name="action" value="principal" class="form-botones">Vista Principal</button>
        </form>
    </div>
    <script>
    function validarFormulario(event) {
      const textarea = document.getElementById('text_mision');
      const texto = textarea.value.trim();

      // Contar las palabras, dividiendo el texto por los espacios
      const palabras = texto.split(/\s+/).filter(Boolean); // filter(Boolean) elimina los elementos vacíos

      // Verificar si hay al menos 3 palabras
      if (palabras.length < 20) {
        alert('Por favor, escribe al menos 20 palabras.');
        event.preventDefault(); // Evitar que se envíe el formulario
      }
    }
  </script>
</body>
</html>
