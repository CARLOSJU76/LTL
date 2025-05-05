


    <div id="contenedor_estados">
  
    <form action="index.php?action=cargar_estados" method="post" enctype="multipart/form-data" id="formulario">
        <h3 style="font-family:'Courier New', Courier, monospace;">Cargar Estados Financieros</h3>   
        <input type="number" style="width:30%; padding: 0.3rem;" id="anio-input" name="nualidad" min="2024" placeholder="AÑO">
        <label for="boton-pdf" id="label-input" class="botones">Elige el archivo</label>
        <input type="file" name="estados_pdf" accept=".pdf" id="boton-pdf"> <!-- No visible-->
        <input type="submit" id="submit-input" name="submit" value="Subir PDF" class="botones">
    </form>

    </div>
    <style>
        #label-input,#anio-input,#submit-input{
            font-size: 0.6rem;
            text-align: center;
        }
        
        #formulario {
            display:flex;
            flex-direction: column;
            align-items:center;
            justify-content:center;
            background-color: #4A0D0D;
            color:gold;            
            width: 40%;
            height: 12rem;
            border-radius: 5px;
            margin-bottom: 5rem;
            border: gold solid 1px;
        }
        #contenedor_estados{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 30rem;
            background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;
        }
        .botones{
            display:flex;
            align-items:center;
            background-color:transparent;
            border: gold solid 1px;
            color:gold;
            font-family: 'Courier New', Courier, monospace;
            border-radius:3px;
            margin:0.2rem;
            width: 8rem;
        
            justify-content:center;
            padding:1%;
            
    cursor: pointer;
        }
        input[type="file"] {
    display: none;
    }
    </style>

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
    
