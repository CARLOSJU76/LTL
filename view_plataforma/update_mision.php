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
        #contenedor, #formulario{
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 40%;
            aspect-ratio: 1/1;
            background-color:#7A1F1F;
        }
        #formulario{
            width: 80%;
        }
        textarea{
            width: 90%;
            aspect-ratio: 1/1;
            font-size: italic;
        }
        #boton-mision{
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:italic;
            font-size: 1.2vw;
            font-weight: bold;
            color:#4A0D0D;
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
        <form action="index.php?action=update_mision" method="post" id="formulario">
            <textarea name="nueva_mision" placeholder="Actualice aquí la misión">
            </textarea>
            <input type="submit" value="Actualizar Misión" id="boton-mision">

        </form>
    </div>
</body>
</html>
