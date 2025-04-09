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

    <?php foreach ($asistencias as $asistencia): ?>
        <div style="margin:1rem; padding:1rem; border:1px solid gold; border-radius:5px;">
            <strong><?= htmlspecialchars($asistencia['nombreD']) . ' ' . htmlspecialchars($asistencia['apellidoD']) ?></strong><br>
            <input type="hidden" name="codigo_asistencia" value="<?= $asistencia['id'] ?>">
            <label for="estimulo">Seleccionar estímulo:</label>
            <select name="estimulo">
                <option value="">-- Ninguno --</option>
                <?php foreach($estimulos as $est): ?>
                    <option value="<?= $est['codigo'] ?>"><?= htmlspecialchars($est['tipo_estimulo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endforeach; ?>

    <input type="submit" value="Otorgar Estímulos" style="padding:0.5rem; font-size:1rem;">
</form>

</body>
</html>