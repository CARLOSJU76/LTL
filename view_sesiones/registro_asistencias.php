
    <div id="contenedor-general">
    <?php if (!empty($sesiones) && !empty($deports)): ?>
        <h3 id="sitio">LTL WebSite</h3>
        <h3>Registrar Asistencia a Sesión de Entrenamiento</h3>
<!-- =================================================================================================== -->

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
            <form id="attendanceForm" action="index.php" method="get">
                <input type="hidden" name="action" value="attendance_register">
                <input type="hidden" name="user_email" id="user_email">
                <button type="submit">Registrar asistencia</button>
            </form>

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
  
  const email = localStorage.getItem('UserEmail');

  document.getElementById('user_email').value = email;

  document.getElementById('attendanceForm').addEventListener('submit', function (e) {
    if (!email) {
      e.preventDefault();
      alert("No se encontró el correo en localStorage.");
    }
  });

</script>

