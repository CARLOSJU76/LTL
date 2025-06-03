

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Slider</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Gestión de Slider</h2>

    <form action="index.php?action=procesar_slider" method="POST" enctype="multipart/form-data">
        <div id="multimediaContainer"></div>
        <button type="button" class="btn btn-secondary my-3" onclick="addInput()">+ Agregar archivo</button>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

    <h3 class="mt-5">Contenido actual</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Vista previa</th>
                <th>Tipo</th>
                <th>Archivo</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <?php if ($item['tipo'] === 'video'): ?>
                        <video src="<?= $item['archivo'] ?>" width="150" controls></video>
                    <?php else: ?>
                        <img src="<?= $item['archivo'] ?>" width="150">
                    <?php endif; ?>
                </td>
                <td><?= ucfirst($item['tipo']) ?></td>
                <td><?= $item['archivo'] ?></td>
                <td><?= $item['activo'] ? 'Sí' : 'No' ?></td>
                <td>
                    <a href="index.php?action=toggle_slider&&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">
                        <?= $item['activo'] ? 'Desactivar' : 'Activar' ?>
                    </a>
                    <a href="index.php?action=eliminar_slider&&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este archivo?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function addInput() {
    const container = document.getElementById('multimediaContainer');
    const inputGroup = document.createElement('div');
    inputGroup.className = "mb-3";
    inputGroup.innerHTML = `
        <input type="file" name="multimedia[]" accept="image/*,video/*" class="form-control" required>
    `;
    container.appendChild(inputGroup);
}
</script>
</body>
</html>
