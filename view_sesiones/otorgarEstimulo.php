<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Otorgar Estímulo a Deportistas Asistentes</h3>

<form action="index.php?action=otorgarEstimulo" method="POST">
    <input type="hidden" name="id_sesion" value="<?= $_GET['id_sesion'] ?? '' ?>">

    <?php foreach ($asistencias as $index => $asistencia): ?>
        <div style="margin:1rem; padding:1rem; border:1px solid gold; border-radius:5px;">
            <strong><?= htmlspecialchars($asistencia['nombreD']) . ' ' . htmlspecialchars($asistencia['apellidoD']) ?></strong><br>
            <input type="hidden" name="codigo_asistencia[]" value="<?= $asistencia['id'] ?>">
            <label for="estimulo">Seleccionar estímulo:</label>
            <select name="estimulo[]">
                <option value="">-- Ninguno --</option>
                <?php foreach($estimulos as $est){
                    $selected = ($asistencia['estimulo'] == $est['tipo_estimulo']) ? 'selected' : '';
                    echo "<option value='{$est['codigo']}' $selected>{$est['tipo_estimulo']}</option>";
                } ?>
            </select>
        </div>
    <?php endforeach; ?>

    <input type="submit" value="Otorgar Estímulos" style="padding:0.5rem; font-size:1rem;">
</form>

<div id="mensaje" style="display:none; padding:1rem; margin-bottom:1rem; border-radius:5px;"></div>

<script>
    // Espera a que cargue el DOM
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const mensaje = urlParams.get('msg');

        if (mensaje) {
            const contenedor = document.getElementById("mensaje");

            // Detectar tipo de mensaje (éxito o error)
            const tipo = urlParams.get('tipo') || 'info';
            let color = '#ccc';
            if (tipo === 'success') color = '#d4edda';
            if (tipo === 'error') color = '#f8d7da';

            contenedor.style.backgroundColor = color;
            contenedor.style.display = 'block';
            contenedor.textContent = decodeURIComponent(mensaje);

            // Ocultar después de unos segundos
            setTimeout(() => {
                contenedor.style.display = 'none';
            }, 5000);
        }
    });
</script>



</body>
</html>