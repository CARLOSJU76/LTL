
    <div id="contenedor-general">
        <h3 id="sitio">LTL WebSite</h3>
        <h3>Registrar Asistencia a Sesión de Entrenamiento</h3>
<!-- =================================================================================================== -->
<?php if (!empty($sesiones) && !empty($deports)): ?>
        <form action="index.php?action=attendance_register" method="POST" id="formulario">
            <label for="sesion">Seleccionar sesión de entrenamiento:</label><br>
            <select name="id_sesion" id="id_sesion">
                <option value="">Elija la sesión</option>
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
                            <input class="deportista" type="checkbox" name="id_deportista[]" value="<?= $depor['id'] ?>"> <?= $depor['nombreD'] . ' ' . $depor['apellidoD'] ?>
                        </label><br>
                    <?php endforeach; ?>
            
        </div>
            <br>
            <input type="submit" value="Registrar Asistencia" id="submit">
        </form>
<!-- =====================BOTÓN OTORGAR ESTÍMULO============================================================================= -->
        <form action="index.php?action=verOtorgarEstimulo" method="get" id="form_otorgar_estimulo">
        <input type="hidden" name="id_sesion" id="id_sesion_hidden">
            <button type="submit" class="boton-sub" style="margin-top: 1rem;" name="action" value="verOtorgarEstimulo">Otorgar Estímulo a Deportistas Asistentes</button>
        </form>
        <?php else: ?>
        <!-- MENSAJE SI NO HAY DATOS SUFICIENTES -->
        <div class="alert-warning" style="margin-top: 1rem;">
            <p>No se encontraron sesiones disponibles o no hay deportistas registrados.</p>
            <p>Por favor, asegúrate de tener sesiones creadas y deportistas asignados a tu cuenta.</p>
        </div>
    <?php endif; ?>
                        
<!-- =================================================================================================== -->
        <div style='display:flex; flex-direction: row; width:65%;margin:3%;' >
            <form action='index.php?action=principal' method='post' id="boton1">
                <button type='submit' name='action' value='principal'  class="boton-sub">Ir al inicio</button>
            </form> 
            <form action='index.php?action=trainer_manage' method='get' id="boton2">
                <button type='submit' name='action' value='trainer_manage' class="boton-sub">Sesiones de Entrenamiento</button>
            </form>
    </div>
    


    </div>
    <script>
    // Script para seleccionar/deseleccionar todos los checkboxes
    document.getElementById('select_all').addEventListener('change', function() {
        // Obtiene todos los checkboxes de deportistas
        const checkboxes = document.querySelectorAll('.deportista');
        
        // Cambia el estado de todos los checkboxes según el checkbox "Seleccionar todos"
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select_all').checked;
        });
    });

    document.getElementById('id_sesion').addEventListener('change', function() {
    document.getElementById('id_sesion_hidden').value = this.value;
});

</script>

