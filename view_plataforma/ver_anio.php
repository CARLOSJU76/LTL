
    
<div id="contenedor">
    <div id="documento_general">
        <form action="index.php?action=ver_estados" method="get" class="form-botones">
            <button type="submit" name="action" value="ver_estados" id="boton_ef">Hacer otra consulta</button>
        </form>
        <h3>Estados Financieros Año: <?= $estates['nualidad']; ?></h3>
        <embed src="pdfs/<?= $estates['pdf']; ?>" width="90%" style="aspect-ratio: 8.5 / 11;" type="application/pdf">
    </div>
   



</div>

<style>
         #contenedor{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('./IMG/LTL/luchafemenil.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
        #documento_general{
            display: flex;
            width: 60%;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #4A0D0D;
        }
       
        h3{
            width: 75%;
            text-justify: center;
           text-align: center;
           font-family: 'Courier New', Courier, monospace;
          
            color:white;
        }
        #boton_ef{
            margin:0.3rem;
            background-color: transparent;
            border: 1px solid gold;
            color: gold;
            border-radius: 3px;
        }
       
    </style>