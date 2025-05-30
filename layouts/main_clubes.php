<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function AccesoDenegado($int){
    if (!isset($_SESSION['perfil'])){
        header("Location: views/no_autorizado.php");
        exit();
        }else{
            $array = str_split($_SESSION['perfil']);
            if( !isset($array[$int]) || $array[$int] != 1){
                header("Location: views/no_autorizado.php");
                exit();
            }
        }
}
AccesoDenegado($permitido);

// Establece el título de la página, si no se define desde la vista, se usa 'Mi sitio'
$title = $title ?? 'Mi sitio'; 
include __DIR__ . '/header_clubes.php';
?>
<!-- ============================================================================================= -->
<?php

// Captura y limpia el mensaje flash desde la sesión
$msg = '';
$tipo = '';

if (isset($_SESSION['msg1'], $_SESSION['tipo1'])) {
    $msg = $_SESSION['msg1'];
    $tipo = $_SESSION['tipo1'];
    unset($_SESSION['msg1'], $_SESSION['tipo1']);
} elseif (isset($_SESSION['msg'], $_SESSION['tipo'])) {
    $msg = $_SESSION['msg'];
    $tipo = $_SESSION['tipo'];
    unset($_SESSION['msg'], $_SESSION['tipo']);
}
?>

<?php if (!empty($msg)): ?>
    <!-- Estilos opcionales para el efecto de desvanecimiento -->
    <style>
        .mensajeFlash {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .mensajeFlash.fade-out {
            opacity: 0;
        }
    </style>

    <!-- Mensaje Flash HTML -->
    <div id="mensajeFlash" class="mensajeFlash"
         style="background-color: <?= $tipo === 'success' ? '#d4edda' : ($tipo === 'error' ? '#f8d7da' : '#ccc') ?>;">
        <?= htmlspecialchars($msg) ?>
    </div>

    <!-- Script para ocultar el mensaje con efecto -->
    <script>
        setTimeout(() => {
            const mensaje = document.getElementById('mensajeFlash');
            if (mensaje) {
                mensaje.classList.add('fade-out');
                // Elimina del DOM tras la transición
                setTimeout(() => mensaje.remove(), 500); // 0.5s coincide con la transición CSS
            }
        }, 5000); // Espera 5 segundos antes de desvanecer
    </script>
<?php endif; ?>
<!-- ============================================================================================= -->

<?php
// Verifica si hay contenido para incluir la vista específica
if (isset($content)) {
    include $content;
}

// Incluye el pie de página
include __DIR__ . '/footer.php';
?>
