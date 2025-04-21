<h2>Registro de Actuaciones</h2>

<?php if (!empty($eventos) && !empty($deportistas)): ?>
    <form action="index.php?action=registrar_actuacion" method="post" id="form-actuacion">
        <!-- Selección de evento -->
        <label for="codigo_evento">Evento:</label>
        <select name="codigo_evento" id="codigo_evento" required>
    <option value="">Selecciona un evento</option>
    <?php foreach ($eventos as $evento): ?>
        <option value="<?= $evento['codigo'] ?>" data-id_ce="<?= $evento['codigo_categoriaxEdad'] ?>">
            <?= htmlspecialchars($evento['nombre_Evento']) ?>
        </option>
    <?php endforeach; ?>
</select>

        <input type="hidden" id="id_ce_evento_seleccionado" value="">

        <hr>

        <h3>Deportistas</h3>

        <div id="contenedor-deportistas">
            <?php foreach ($deportistas as $index => $deportista): ?>
                <div class="bloque-deportista">
                    <label>
                        <input type="checkbox" name="id_deportistas[]" value="<?= $deportista['id'] ?>" class="check-deportista">
                        <?= htmlspecialchars($deportista['nombres'] . ' ' . $deportista['apellidos']) ?>
                    </label>

                    <div class="datos-extra" style="display: none;">
                        <label>Modalidad:
                            <select name="modalidades[]" class="select-modalidad">
                                <option value="">Selecciona una modalidad</option>
                                <?php foreach ($modalidades as $mod): ?>
                                    <option value="<?= $mod['id'] ?>"><?= htmlspecialchars($mod['modalidad']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>

                        <label>Categoría x Peso:
                            <select name="categoriasxPeso[]" class="select-categoriaxpeso">
                               <option value="">Primero seleccione una Modalidad</option>
                               
                            </select>
                        </label>

                        <label>Posición:
                            <input type="number" name="posiciones[]" min="1" max="20">
                        </label>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>

        <input type="submit" value="Registrar actuaciones">
    </form>

<?php else: ?>
    <p style="color: red;">No hay eventos o deportistas disponibles para registrar actuaciones.</p>
<?php endif; ?>

<!-- Estilos -->
<style>
    .bloque-deportista {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .datos-extra {
        margin-top: 10px;
        padding-left: 15px;
    }

    form input[type="submit"] {
        margin-top: 20px;
        padding: 10px 15px;
    }
</style>

<!-- Script para mostrar/ocultar datos extra -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const idCeInput = document.getElementById('id_ce_evento_seleccionado');

    // Capturar el id_ce del evento seleccionado
    document.getElementById('codigo_evento').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const id_ce = selected.getAttribute('data-id_ce');
        idCeInput.value = id_ce;
    });

    // Mostrar u ocultar datos extra al seleccionar un deportista
    document.querySelectorAll('.check-deportista').forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const extra = this.closest('.bloque-deportista').querySelector('.datos-extra');
            extra.style.display = this.checked ? 'block' : 'none';
        });
    });

    // Cargar dinámicamente las categorías x peso al seleccionar una modalidad
    document.querySelectorAll('.select-modalidad').forEach((modalidadSelect) => {
        modalidadSelect.addEventListener('change', function () {
            const bloque = this.closest('.datos-extra');
            const selectCategoriaPeso = bloque.querySelector('.select-categoriaxpeso');

            const id_mod = this.value;
            const id_ce = idCeInput.value;

            if (!id_mod || !id_ce) {
                selectCategoriaPeso.innerHTML = '<option value="">Seleccione modalidad primero</option>';
                return;
            }

            fetch(`index.php?action=obtener_categoriasxpeso&id_ce=${id_ce}&id_mod=${id_mod}`)
                .then(response => response.json())
                .then(data => {
                    selectCategoriaPeso.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(cat => {
                            const option = document.createElement('option');
                            option.value = cat.codigo;
                            option.textContent = cat.categoriaxPeso;
                            selectCategoriaPeso.appendChild(option);
                        });
                    } else {
                        selectCategoriaPeso.innerHTML = '<option value="">No hay categorías disponibles</option>';
                    }
                })
                .catch(err => {
                    console.error('Error al obtener categorías:', err);
                    selectCategoriaPeso.innerHTML = '<option value="">Error al cargar</option>';
                });
        });
    });
});
</script>
