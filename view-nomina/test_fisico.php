<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$email = $_SESSION['email'] ?? 'debes iniciar sesión!!';
include_once './controller/DeportistaController.php';
$objeto = new DeportistaController();

$entrenador_id = $objeto->get_idEntrenador_by_email($email)['id'];
?>
<!-- ======================================================================== -->
 <div id=fondo-test>
<form id="formulario-prueba" action="index.php?action=ejecutar_prueba" method="post">
    <h3 style=" color:#842029; font-style:italic; ">Registrar Test Físico</h3>

    <!-- Seleccionar prueba -->
    <label for="prueba_id" style=" color:#842029; font-style:italic; letter-spacing:0.3rem; font-weight:normal;" >Prueba:</label>
    <select name="prueba_id" id="prueba_id" required>
        <?php foreach ($pruebas as $prueba): ?>
            <option value="<?= htmlspecialchars($prueba['id']) ?>">
                <?= htmlspecialchars($prueba['nombre_prueba']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Seleccionar fecha -->
    <label for="fecha" style=" color:#842029; font-style:italic; letter-spacing:0.3rem; font-weight:normal;" >Fecha:</label>
    <input type="date" name="fecha" id="prueba_fecha" required><br>

    <!-- Contenedor deportistas -->
    <div id="deportistas-container">
        <div class="deportista-item" data-index="0">
            <select name="deportista[0][deportista_id]" class="dep-id" required>
                <option value="">Seleccione un deportista</option>
                <?php foreach ($deportistas as $deportista): ?>
                    <option value="<?= htmlspecialchars($deportista['id']) ?>">
                        <?= htmlspecialchars($deportista['nombres']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="deportista[0][resultado]" class="dep-res" placeholder="Resultado" step="0.001" required>
        </div>
    </div>

    <!-- Botón para añadir más deportistas -->
    <button type="button" id="agregar-dep" onclick="agregarDeportista()">Agregar otro deportista</button>

    <!-- Contenedor mensaje error -->
    <div id="mensaje-error" class="alert alert-danger" style="display: none;"></div>

    <!-- ID entrenador oculto -->
    <input type="hidden" name="entrenador_id" value="<?= htmlspecialchars($entrenador_id) ?>">

    <!-- Enviar -->
    <input type="submit" id="prueba-reg" value="Registrar Prueba">
</form>
 </div>
<!-- ======================================================================== -->
 <style>
    #fondo-test {
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
    }
    #formulario-prueba {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 6px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 3rem;
    }
    #prueba_id, #prueba_fecha {
        width: 70%;
        padding: 0.3rem;
        margin-bottom: 1rem;
        border-radius: 4px;
        border: 1px solid #842029;
        text-align: center;
        font-size: 0.9rem;
        font-style: italic;
        letter-spacing: 0.3rem;
    }
    #deportistas-container{
        width: 72%;
    }
    .deportista-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 1rem;
        width: 100%;
      
    }
    .dep-id{
        width: 80%;
        padding: 0.4rem;
        font-size:0.8rem;
        margin-right: 0.5rem;
        border-radius: 4px;
        border: 1px solid #842029;
        font-style: italic;
        letter-spacing: 0.3rem;
    }
    .dep-res{
        width: 20%;
        padding: 0.4rem;
        font-size:0.8rem;
        border-radius: 4px;
       border: 1px solid #842029;
       font-style: italic;
        text-align: center;
        letter-spacing: 0.1rem;
        
    }
    #agregar-dep, #prueba-reg {
        width: 60%;
        background-color: transparent;
        color: black;
       border: 1px solid #842029;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
        margin-bottom: 1rem;
         font-style: italic;
        letter-spacing: 0.3rem;
    }
    #agregar-dep:hover, #prueba-reg:hover {
        background-color:green;
        color:  #f8d7da;
    }
.alert-danger {
    background-color: #f8d7da;
    color: #842029;
    padding: 12px;
    border: 1px solid #f5c2c7;
    border-radius: 5px;
    margin-top: 10px;
}
</style>
<!-- ======================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Sincronizar opciones al cargar
    actualizarOpcionesDisponibles();

    // Actualizar opciones cuando cambie un select
    document.getElementById('deportistas-container').addEventListener('change', function (e) {
        if (e.target.tagName === 'SELECT') {
            actualizarOpcionesDisponibles();
            ocultarMensajeError();
        }
    });
});

function agregarDeportista() {
    const contenedor = document.getElementById('deportistas-container');
    const items = contenedor.querySelectorAll('.deportista-item');
    const nuevoIndice = items.length;

    const ultimo = items[items.length - 1];
    const clon = ultimo.cloneNode(true);
    clon.setAttribute('data-index', nuevoIndice);

    const select = clon.querySelector('select');
    const input = clon.querySelector('input');

    select.name = `deportista[${nuevoIndice}][deportista_id]`;
    input.name = `deportista[${nuevoIndice}][resultado]`;
    input.value = '';
    select.selectedIndex = 0;

    contenedor.appendChild(clon);

    actualizarOpcionesDisponibles();
}

function actualizarOpcionesDisponibles() {
    const contenedor = document.getElementById('deportistas-container');
    const selects = contenedor.querySelectorAll('select');

    const valoresSeleccionados = Array.from(selects)
        .map(select => select.value)
        .filter(val => val !== '');

    selects.forEach(select => {
        const valorActual = select.value;
        const opciones = select.querySelectorAll('option');

        opciones.forEach(op => {
            if (op.value === '') {
                op.hidden = false;
            } else if (valorActual === op.value) {
                op.hidden = false;
            } else {
                op.hidden = valoresSeleccionados.includes(op.value);
            }
        });
    });
}

function ocultarMensajeError() {
    const mensajeError = document.getElementById('mensaje-error');
    mensajeError.style.display = 'none';
}

document.getElementById('formulario-prueba').addEventListener('submit', function (e) {
    const selects = document.querySelectorAll('#deportistas-container select');
    const valores = Array.from(selects).map(s => s.value).filter(v => v !== '');

    const mensajeError = document.getElementById('mensaje-error');
    mensajeError.style.display = 'none';

    const valoresUnicos = new Set(valores);
    if (valores.length !== valoresUnicos.size) {
        e.preventDefault();
        mensajeError.textContent = "⚠️ No puedes registrar al mismo deportista más de una vez.";
        mensajeError.style.display = 'block';
        return false;
    }
});
</script>

