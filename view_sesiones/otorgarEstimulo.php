
<div id="fondo-estimulo">
<form action="index.php?action=otorgarEstimulo" method="POST" id="form-estimulo">
    <h3>Otorgar Estímulo a Deportistas Asistentes</h3>

    <input type="hidden" name="id_sesion" value="<?= $_GET['id_sesion'] ?? '' ?>">

    <?php foreach ($asistencias as $index => $asistencia): ?>
        <div class="d-estimulo">
            <strong><?= htmlspecialchars($asistencia['nombreD']) . ' ' . htmlspecialchars($asistencia['apellidoD']) ?></strong><br>
            <input type="hidden" name="codigo_asistencia[]" value="<?= $asistencia['id'] ?>">
            <label for="estimulo">Seleccionar estímulo:</label>
            <select class="select-estimulo" name="estimulo[]">
                <option value="">-- Ninguno --</option>
                <?php foreach($estimulos as $est){
                    $selected = ($asistencia['estimulo'] == $est['tipo_estimulo']) ? 'selected' : '';
                    echo "<option value='{$est['codigo']}' $selected>{$est['tipo_estimulo']}</option>";
                } ?>
            </select>
        </div>
    <?php endforeach; ?>

    <input type="submit" id="submit-estimulo" value="Otorgar Estímulos">
</form>

<div id="mensaje" style="display:none; padding:1rem; margin-bottom:1rem; border-radius:5px;"></div>
</div>
<!-- ============================================================================================== -->
 <style>
    #fondo-estimulo{
        background-image: url('./IMG/LTL/mat.jpg');
            /* background-size: cover; Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
    }
    #form-estimulo{
        width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color:#DCE1DE;
        margin:2rem;
        padding: 1rem;
        border-radius:4px;
        border: #D4AF37 solid 1px;
    }
    .d-estimulo{
        margin:1rem; padding:1rem; border:1px solid gold; border-radius:5px;
        width: 60%;
    }
    #submit-estimulo{
        background-color: transparent;
        color:black;
        border:#D4AF37 solid 2px;
        font-style: italic;
        font-weight: lighter;
        letter-spacing: 0.2rem;
        padding: 0.4rem;
        border-radius: 3px;
    }
    #submit-estimulo:hover{
        background-color: #4A0D0D;
        color:#D4AF37;
        border:#D4AF37 solid 1px;
    }
    .select-estimulo{
        padding:0.3rem;
        font-style: italic;
        letter-spacing: 0.2rem;
        border: #4A0D0D solid 1px;
        border-radius: 3px;
    }

 </style>

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