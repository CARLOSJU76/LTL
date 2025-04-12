<?php
// Establece el título de la página, si no se define desde la vista, se usa 'Mi sitio'
$title = $title ?? 'Mi sitio'; 
include __DIR__ . '/header.php';
?>

<!-- Div para los mensajes -->
<div id="mensaje" style="display:none; padding:1rem; margin-bottom:1rem; border-radius:5px;"></div>

<script>
    // Espera a que cargue el DOM
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const mensaje = urlParams.get('msg'); // Obtiene el mensaje de la URL

        if (mensaje) {
            const contenedor = document.getElementById("mensaje");

            // Detecta el tipo de mensaje (éxito o error), por defecto es 'info'
            const tipo = urlParams.get('tipo') || 'info';
            let color = '#ccc'; // Color predeterminado

            // Cambia el color según el tipo de mensaje
            if (tipo === 'success') color = '#d4edda'; // verde para éxito
            if (tipo === 'error') color = '#f8d7da'; // rojo para error

            contenedor.style.backgroundColor = color;
            contenedor.style.display = 'block'; // Muestra el contenedor
            contenedor.textContent = decodeURIComponent(mensaje); // Muestra el mensaje decodificado

            // Oculta el contenedor después de unos segundos
            setTimeout(() => {
                contenedor.style.display = 'none';
            }, 5000);
        }
    });
</script>

<?php
// Verifica si hay contenido para incluir la vista específica
if (isset($content)) {
    include $content;
}

// Incluye el pie de página
include __DIR__ . '/footer.php';
?>
