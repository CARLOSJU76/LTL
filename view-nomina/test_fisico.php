<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$email= $_SESSION['email'] ?? 'debes iniciar sesión!!';
include_once './controller/DeportistaController.php';
$objeto= new DeportistaController();

$entrenador_id= $objeto->get_idEntrenador_by_email($email)['id'];
?>



<form action="index.php?action=ejecutar_prueba" method="post">
    <h3>Registrar Test Físico</h3>

    <!-- Seleccionar prueba -->
    <label>Prueba:</label>
    <select name="prueba_id" required>
        <?php foreach ($pruebas as $prueba): ?>
            <option value="<?= $prueba['id'] ?>">
                <?= htmlspecialchars($prueba['nombre_prueba']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
<!-- ==================================================================================== -->
    <!-- Seleccionar fecha -->
    <label>Fecha:</label>
    <input type="date" name="fecha" required><br><br>
<!-- ==================================================================================== -->
    <!-- Múltiples deportistas y resultados -->
    <div id="deportistas-container">
        <div class="deportista-item">
            <select name="deportistas[]" required>
                <option value="">Seleccione un deportista</option>
                <?php foreach ($deportistas as $deportista): ?>
                    <option value="<?= $deportista['id'] ?>">
                        <?= htmlspecialchars($deportista['nombres']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
<!-- ==================================================================================== -->
            <input type="number" name="resultados[]" placeholder="Resultado" step="0.001" required>
        </div>
    </div>

    <!-- Botón para añadir más deportistas -->
    <button type="button" onclick="agregarDeportista()">Agregar otro deportista</button><br><br>

    <!-- ID del entrenador oculto -->
    <input type="hidden" name="entrenador_id" value="<?= $entrenador_id ?>">

    <!-- Enviar -->
    <input type="submit" value="Registrar Prueba">
</form>

<script>
function agregarDeportista() {
    const contenedor = document.getElementById('deportistas-container');
    const item = document.querySelector('.deportista-item');
    const clon = item.cloneNode(true);
    clon.querySelector('select').selectedIndex = 0;
    clon.querySelector('input').value = '';
    contenedor.appendChild(clon);
}
</script>
