<!-- <pre>
<?php
    echo "Valor de \$fechaA: ";
    var_dump($fechaA);
    echo "Sesiones:";
    var_dump($sesiones);
    echo "Deportistas:";
    var_dump($deports);
?>
</pre> -->

<div id="contenedor-general">
    <h3 style="color: #D4AF37;" id="sitio">LTL WebSite</h3>
   
    <?php if (!empty($sesiones) && !empty($deports)): ?>
    <div id="contenedor_form"> 
        <h3 style="color: #4A0D0D">Registrar Asistencia a Sesión de Entrenamiento</h3>

        <!-- Formulario para seleccionar sesión y deportistas -->
        <form action="index.php?action=attendance_register" method="POST" id="formulario">
            <label for="sesion" style="color: #4A0D0D; font-weight:bold;">Seleccionar sesión de entrenamiento:</label><br>
            <select name="id_sesion" id="id_sesion">
                <option id="opcion_elija" style="font-size:0.8rem;"  value="">Elija la sesión</option>
                <?php
                    foreach($sesiones as $sesion){
                        echo "<option  value='".htmlspecialchars($sesion['codigo'])."'>". 
                             "Fecha: ".htmlspecialchars($sesion['fecha']). " /  Hora: ".htmlspecialchars($sesion['hora']). 
                             "</option>";
                    }
                ?>
            </select>

            <div id="asistentes">
                <p>Seleccionar deportistas que asistieron a la sesión:</p>
                <input type="checkbox" id="select_all" /> Seleccionar todos<br><br>
                <?php
                    foreach($deports as $depor): ?>
                        <label>
                            <input class="deportista" type="checkbox" style="font-style: italic;" name="id_deportista[]" value="<?= $depor['id'] ?>"> <?= $depor['nombreD'] . ' ' . $depor['apellidoD'] ?>
                        </label><br>
                    <?php endforeach; ?>
            </div>

            <br>
            <input type="submit" value="Registrar Asistencia" id="submit">
        </form>

        <!-- Botón para otorgar estímulo -->
        <form action="index.php?action=verOtorgarEstimulo" method="get" id="form_otorgar_estimulo">
            <input type="hidden" name="id_sesion" id="id_sesion_hidden">
            <button type="submit" class="boton-sub" name="action" value="verOtorgarEstimulo">Otorgar Estímulo a Deportistas Asistentes</button>
        </form>
    </div>

    <?php else: ?>

        
        
        <!-- <form id="attendanceForm" action="index.php" method="get">
            <input type="hidden" name="action" value="attendance_register">
            <input type="hidden" name="user_email" id="user_email">
            <button type="submit">Registrar asistencia</button>
        </form> -->

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const email = localStorage.getItem('UserEmail');
                const userEmailField = document.getElementById('user_email');
                
                if (userEmailField) {
                    userEmailField.value = email;

                    const form = document.getElementById('attendanceForm');
                    if (form) {
                        form.addEventListener('submit', function (e) {
                            if (!email) {
                                e.preventDefault();
                                alert("No se encontró el correo en localStorage.");
                            }
                        });
                    }
                }
            });
        </script>
    <?php endif; ?>

</div>

<script>
    // Script para seleccionar/deseleccionar todos los checkboxes
    document.getElementById('select_all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.deportista');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select_all').checked;
        });
    });

    document.getElementById('id_sesion').addEventListener('change', function() {
        document.getElementById('id_sesion_hidden').value = this.value;
    });
</script>

<style>
    /* Estilo para centrar el formulario */
    #formulario {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        /* background-color: #f4f4f9; */
        border-radius: 8px;
    }
    #contenedor_form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 60%;
        background-color: #f4f4f9;
        margin: 2rem;
        border: #D4AF37 3px solid;
        border-radius: 4px;
    }
    #id_sesion{
        width: 20rem;
        padding: 0.3rem;
        font-size: 1rem;
        margin-bottom: 1rem;
        border:#4A0D0D solid 2px;
        border-radius: 3px;
        font-style: italic;
    }

    /* Estilo para los botones */
    .boton-sub, #submit {
        padding: 0.3rem;
        background-color: transparent;
        color: #800000;  /* Color vinotinto */
        border: 2px solid #FFD700; /* Borde oro */
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 1rem;  /* Espacio entre los botones */
        width: 20rem;;
    }
    

    .boton-sub:hover, #submit:hover {
        background-color: #800000; /* Vinotinto de fondo */
        color: white; /* Texto blanco */
    }

    /* Alineación horizontal para los botones */
    .button-container {
        display: flex;
        justify-content: center; /* Centrar los botones horizontalmente */
        margin-top: 20px;
    }

    /* Estilo para los inputs y select */
    #formulario input[type="checkbox"],
    #formulario select {
        margin: 10px 0;
    }

    /* Alinear los botones del formulario "Registrar asistencia" */
    #attendanceForm {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    #attendanceForm button {
        padding: 10px 20px;
        background-color: transparent;
        color: #800000; /* Vinotinto */
        border: 2px solid #FFD700; /* Borde oro */
        border-radius: 5px;
        cursor: pointer;
    }

    #attendanceForm button:hover {
        background-color: #800000;
        color: white;
    }
    #contenedor-general{
       background-image: url('./IMG/LTL/mat.jpg');
            /* background-size: cover; Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
    }
   #opcion_elija{
    padding: 0.5rem; 
    font-size: 1rem;   
   }
</style>
