<div class="container mt-5">
    <h2>Editar Slider</h2>

    <form action="index.php?action=editar_slider" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($slider['id']) ?>">

        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($slider['titulo']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($slider['descripcion']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php?action=admin_slider" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
