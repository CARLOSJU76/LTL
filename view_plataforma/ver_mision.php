<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misión de La Liga Tolimense de Lucha</title>
    <style>
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
            font-family: italic;
            font-size: 1.3vw;
            padding: 5%;
            color:white;
        }
        h2{
            font-family: italic;
            font-size:1.5vw;
            margin:5%;
            color:white;
        }
    </style>
</head>
<body>
    <div>
    <p >
        <h2>Nuestra Misión:</h2>
        <?php
        echo "<p>". $mision['mision'] ."<p>";
        ?>
    </p>

    </div>
    
</body>
</html>