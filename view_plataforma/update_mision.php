
    <div id="contenedor">
       
        <form action="index.php?action=update_mision" method="post" class="formulario" id="formulario"onsubmit="validarFormulario(event)">
            <h2>Actualizace la Misión:</h2>    
            <textarea name="nueva_mision" placeholder="Actualice aquí la misión" id="text_mision">   <?php echo $mision['mision']  ?></textarea>
            <input type="submit" value="Actualizar Misión" id="boton_update_mision">
        </form>
        
    </div>
    <style>
        #contenedor{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;
           
        }
        #formulario{
            width: 60%;
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 20rem;
            background-color:#7A1F1F;
            border-radius: 4px;
            border:solid 1px #4A0D0D ;
        }
        textarea{
            width: 90%;
            height:100%;
            margin: 0.5em;
            font-size: 1rem;
            font-style: italic;
        }
        #boton_update_mision{
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
