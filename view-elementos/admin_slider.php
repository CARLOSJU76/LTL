<div id="fondo-slide">
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
                <th>Título</th>
                <th>Descripción</th>
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
                <td><?= htmlspecialchars($item['titulo'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['descripcion'] ?? '') ?></td>
                <td><?= $item['activo'] ? 'Sí' : 'No' ?></td>
                <td>
                    <a href="index.php?action=toggle_slider&&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">
                        <?= $item['activo'] ? 'Desactivar' : 'Activar' ?>
                    </a>
                    <a href="index.php?action=eliminar_slider&&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este archivo?')">Eliminar</a>
                    <a href="index.php?action=editar_slider&&id=<?= $item['id'] ?>" class="btn btn-info btn-sm">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<link rel="stylesheet" href="CSS/bootstrap.min.css">
<style>
#fondo-slide{
    width: 100%;
    background-image: url('./IMG/LTL/renteria.jpg');
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.container {
    background-color: #4A0D0D;
    color:#D4AF37;
    font-style: italic;
    border:#D4AF37 solid 2px;
    border-radius: 5px;
    margin: 2rem;
}
</style>

<script>
function addInput() {
    const container = document.getElementById('multimediaContainer');
    const inputGroup = document.createElement('div');
    inputGroup.className = "mb-3";
    inputGroup.innerHTML = `
        <input type="file" name="multimedia[]" accept="image/*,video/*" class="form-control mb-2" required>
        <input type="text" name="titulo[]" placeholder="Título" class="form-control mb-2">
        <textarea name="descripcion[]" placeholder="Descripción" class="form-control mb-2"></textarea>
    `;
    container.appendChild(inputGroup);
}
</script>
