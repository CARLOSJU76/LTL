<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 700px; width: 100%;">
        <h2 class="text-center mb-4 text-primary">Editar Slider</h2>
        <form action="index.php?action=editar_slider" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($slider['id'] ?? '') ?>">

            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label fw-bold">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control"
                       value="<?= htmlspecialchars($slider['titulo'] ?? '') ?>" required>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($slider['descripcion'] ?? '') ?></textarea>
            </div>

            <!-- Posición Vertical -->
            <div class="mb-3">
                <label for="posicion_vertical" class="form-label fw-bold">Posición Vertical:</label>
                <select name="posicion_vertical" id="posicion_vertical" class="form-select">
                    <option value="arriba" <?= ($slider['posicion_vertical'] ?? '') === 'arriba' ? 'selected' : '' ?>>Arriba</option>
                    <option value="centro" <?= ($slider['posicion_vertical'] ?? '') === 'centro' ? 'selected' : '' ?>>Centro</option>
                    <option value="abajo" <?= ($slider['posicion_vertical'] ?? '') === 'abajo' ? 'selected' : '' ?>>Abajo</option>
                </select>
            </div>

            <!-- Posición Horizontal -->
            <div class="mb-3">
                <label for="justificacion_horizontal" class="form-label fw-bold">Posición Horizontal:</label>
                <select name="justificacion_horizontal" id="justificacion_horizontal" class="form-select">
                    <option value="izquierda" <?= ($slider['justificacion_horizontal'] ?? '') === 'izquierda' ? 'selected' : '' ?>>Izquierda</option>
                    <option value="centro" <?= ($slider['justificacion_horizontal'] ?? '') === 'centro' ? 'selected' : '' ?>>Centro</option>
                    <option value="derecha" <?= ($slider['justificacion_horizontal'] ?? '') === 'derecha' ? 'selected' : '' ?>>Derecha</option>
                </select>
            </div>

            <!-- ===== Estilos de Fuente para Título ===== -->
            <h5 class="text-secondary mt-4">Estilos de Fuente para Título</h5>
            <div class="mb-3">
                <label for="titulo_color" class="form-label">Color:</label>
                <input type="color" name="titulo_color" id="titulo_color" class="form-control form-control-color"
                       value="<?= htmlspecialchars($slider['titulo_color'] ?? '#000000') ?>">
            </div>

            <div class="mb-3">
                <label for="titulo_tamano" class="form-label">Tamaño (ej: 16px):</label>
                <input type="text" name="titulo_tamano" id="titulo_tamano" class="form-control"
                       value="<?= htmlspecialchars($slider['titulo_tamano'] ?? '16px') ?>">
            </div>

            <div class="mb-3">
                <label for="titulo_estilo" class="form-label">Estilo:</label>
                <select name="titulo_estilo" id="titulo_estilo" class="form-select">
                    <option value="normal" <?= ($slider['titulo_estilo'] ?? '') === 'normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="negrita" <?= ($slider['titulo_estilo'] ?? '') === 'negrita' ? 'selected' : '' ?>>Negrita</option>
                    <option value="cursiva" <?= ($slider['titulo_estilo'] ?? '') === 'cursiva' ? 'selected' : '' ?>>Cursiva</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="titulo_fuente" class="form-label">Fuente:</label>
                <select name="titulo_fuente" id="titulo_fuente" class="form-select">
                    <option value="Arial" <?= ($slider['titulo_fuente'] ?? '') === 'Arial' ? 'selected' : '' ?>>Arial</option>
                    <option value="Verdana" <?= ($slider['titulo_fuente'] ?? '') === 'Verdana' ? 'selected' : '' ?>>Verdana</option>
                    <option value="Courier New" <?= ($slider['titulo_fuente'] ?? '') === 'Courier New' ? 'selected' : '' ?>>Courier New</option>
                    <option value="Times New Roman" <?= ($slider['titulo_fuente'] ?? '') === 'Times New Roman' ? 'selected' : '' ?>>Times New Roman</option>
                    <option value="Georgia" <?= ($slider['titulo_fuente'] ?? '') === 'Georgia' ? 'selected' : '' ?>>Georgia</option>
                </select>
            </div>

            <!-- ===== Estilos de Fuente para Descripción ===== -->
            <h5 class="text-secondary mt-4">Estilos de Fuente para Descripción</h5>
            <div class="mb-3">
                <label for="descripcion_color" class="form-label">Color:</label>
                <input type="color" name="descripcion_color" id="descripcion_color" class="form-control form-control-color"
                       value="<?= htmlspecialchars($slider['descripcion_color'] ?? '#000000') ?>">
            </div>

            <div class="mb-3">
                <label for="descripcion_tamano" class="form-label">Tamaño (ej: 16px):</label>
                <input type="text" name="descripcion_tamano" id="descripcion_tamano" class="form-control"
                       value="<?= htmlspecialchars($slider['descripcion_tamano'] ?? '16px') ?>">
            </div>

            <div class="mb-3">
                <label for="descripcion_estilo" class="form-label">Estilo:</label>
                <select name="descripcion_estilo" id="descripcion_estilo" class="form-select">
                    <option value="normal" <?= ($slider['descripcion_estilo'] ?? '') === 'normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="negrita" <?= ($slider['descripcion_estilo'] ?? '') === 'negrita' ? 'selected' : '' ?>>Negrita</option>
                    <option value="cursiva" <?= ($slider['descripcion_estilo'] ?? '') === 'cursiva' ? 'selected' : '' ?>>Cursiva</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion_fuente" class="form-label">Fuente:</label>
                <select name="descripcion_fuente" id="descripcion_fuente" class="form-select">
                    <option value="Arial" <?= ($slider['descripcion_fuente'] ?? '') === 'Arial' ? 'selected' : '' ?>>Arial</option>
                    <option value="Verdana" <?= ($slider['descripcion_fuente'] ?? '') === 'Verdana' ? 'selected' : '' ?>>Verdana</option>
                    <option value="Courier New" <?= ($slider['descripcion_fuente'] ?? '') === 'Courier New' ? 'selected' : '' ?>>Courier New</option>
                    <option value="Times New Roman" <?= ($slider['descripcion_fuente'] ?? '') === 'Times New Roman' ? 'selected' : '' ?>>Times New Roman</option>
                    <option value="Georgia" <?= ($slider['descripcion_fuente'] ?? '') === 'Georgia' ? 'selected' : '' ?>>Georgia</option>
                </select>
            </div>

            <!-- ===== Botones ===== -->
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary w-50 me-2">Guardar Cambios</button>
                <a href="index.php?action=admin_slider" class="btn btn-secondary w-50 ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>