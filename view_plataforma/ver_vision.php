<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misión de La Liga Tolimense de Lucha</title>
    <style>
         @font-face {
  font-family: 'fuente2';
  src: url('fonts/fuente2.ttf') format('truetype');/*Nombre real : struck */
}

        body{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        div{
            width: 40%;
            aspect-ratio: 1/1;
            background-color:  #7A1F1F;
            margin:5%;
            border: solid gold 2px;

        }
        p{
            font-family: 'fuente3';
            font-size: 1.3vw;
            padding: 5%;
            color:white;
            font-style:italic;
            letter-spacing: 3px;
        }
        h2{
            font-family: 'fuente3';
            font-size:1.5vw;
            margin:5%;
            color:white;
            font-style:italic;
            letter-spacing: 4px;
        }
        #form_boton{
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
           
        }
        .botones{
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:italic;
            font-size: 1.2vw;
            font-weight: bold;
            color:#4A0D0D;
            margin:4%;
        }
    </style>
</head>
<body>
    <div>
    <p >
        <h2>Nuestra Visión:</h2>
        <?php
        echo "<p>". $vision['vision'] ."<p>";
        ?>
    </p>
    <form action="index.php?action=club_principal" method="get" class="form-botones" id="form_boton">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
    </form>

    </div>