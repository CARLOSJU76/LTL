<!-- ======================================================================================================= -->
<div id="contenedor">
        <div id="div-mision">
            <h2 id="tit-mision">Nuestra Visión:</h2>
            <p class="p-mision">                
                <?php echo "<p class='p-mision'>". $vision['vision'] ."<p>"; ?>
            </p>
        </div>
    </div>
<!-- ======================================================================================================= -->

<style>
        @font-face {
  font-family: 'fuente2';
  src: url('fonts/fuente2.ttf') format('truetype');/*Nombre real : struck */
}

#contenedor{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }
        #div-mision{
            width: 60%;
            background-color:#4A0D0D;
            margin:1rem;
            border: solid gold 1px;
            border-radius: 3px;
            padding: 2rem;
        }
        .p-mision{
            font-family: 'fuente3';
            font-size: 1.3vw;
            color:white;
            line-height: 2;
            font-style:italic;
            letter-spacing: 0.2rem;
        
        }
        #tit-mision{
            font-family: 'fuente3';
            font-size:1.5vw;
            margin:1rem;
            color:white;
            font-style:italic;
            letter-spacing: 4px;
        }
        
    </style>
