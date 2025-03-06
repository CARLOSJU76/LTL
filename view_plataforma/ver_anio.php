<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body{
            display: flex;
       justify-content: center;
            background-image: url('./IMG/LTL/luchafemenil.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
        #contenedor{
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #7A1F1F;
            
        }
        h3{
            width: 75%;
            text-justify: center;
           text-align: center;
           font-family: 'Courier New', Courier, monospace;
          
            color:white;
        }
        #botones{
            display: flex;
            flex-direction: row;
            margin:1%;
            align-items: flex-start;
        }
        .botones{  
        
        background: linear-gradient(to bottom, #ffd700, white);
        box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
        border-radius: 5px;
        font-family:'Courier New', Courier, monospace;
        font-size: 1vw;
        color:#4A0D0D;
       height:100%;
}
    </style>
</head>
<body>
    
<div id="contenedor">
    <div id="botones">
        <form action="index.php?action=ver_estados" method="get" class="form-botones">
            <button type="submit" name="action" value="ver_estados" class="botones">Ir a Estados Financieros</button>
        </form>
      
        <form action="index.php?action=club_principal" method="get" class="form-botones">
            <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
        </form>
</div>
    <h3>Estados Financieros Año: <?= $estates['nualidad']; ?></h3>
    <div></div>
<embed src="pdfs/<?= $estates['pdf']; ?>" width="90%" style="aspect-ratio: 8.5 / 11;" type="application/pdf">


</div>


</body>
</html>