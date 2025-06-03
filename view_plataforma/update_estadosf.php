<div id="contenedor_estados">
<form action="index.php?action=update_estados" method="POST" id="formulario"  enctype="multipart/form-data" >
    <h3 style="font-family:'Courier New', Courier, monospace;">Actualizar Estados Financieros</h3>
    <select name="id_estado" id="select-estados" class="form-select form-select-lg">
         <option value="">Elija el año</option>
         <?php
            foreach($estadosf as $est){
                echo "<option value='".htmlspecialchars($est['id'])."'>"
                .htmlspecialchars($est['nualidad'])."</option>";
            }
         ?>
    </select>
        <!-- input para elegir el archivo -->
        <label for="boton-pdf" id="label-input" class="botones">Elige el archivo</label>
        <input type="file" name="estados_pdf" accept=".pdf" id="boton-pdf"> <!-- No visible-->
        <!-- Botón Submit -->
        <input type="submit" id="submit-input" name="submit" value="Actualizar" class="botones">
   
</form>
</div>
<!-- ============================================================================ -->

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
        #select-estados{
            width: 16rem;
            margin: 0.2rem;
            font-family: 'Courier New', Courier, monospace;
            color:blacK;
            font-style: italic;
            font-weight: lighter;
            font-size: 1.2rem;
            letter-spacing: 0.3rem;
            justify-content: center;
            background-color: white;
            border: gold solid 1px;
            border-radius: 3px;
        }
        .botones{
            display:flex;
            align-items:center;
            background-color:transparent;
            border: gold solid 1px;
            color:gold;
            font-family: 'Courier New', Courier, monospace;
            font-style: italic;
            letter-spacing: 0.2rem;
            border-radius:3px;
            margin:0.2rem;
            width: 15rem;
            justify-content:center;
            padding:1%;
            cursor: pointer;
        }
        input[type="file"] {
    display: none;
    }
    #label-input, #submit-input {
        font-size: 1rem;
    }
    #submit-input:hover, #label-input:hover {
        background-color: gold;
        color: black;
        transition: background-color 0.3s ease, color 0.3s ease;
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