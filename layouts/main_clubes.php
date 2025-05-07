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


<?php if (isset($_SESSION['msg']) && isset($_SESSION['tipo'])): ?>
    <div id="mensajeFlash" style="padding:1rem; margin-bottom:1rem; border-radius:5px; background-color:
        <?= $_SESSION['tipo'] === 'success' ? '#d4edda' : ($_SESSION['tipo'] === 'error' ? '#f8d7da'  : '#ccc') ?>;">
        <?= htmlspecialchars($_SESSION['msg']) ?>
    </div>
    <script>
        setTimeout(() => {
            const div = document.getElementById('mensajeFlash');
            if (div) {
                div.style.display = 'none';
            }
        }, 5000);
    </script>

    <?php
    // Limpieza después de mostrar
    unset($_SESSION['msg'], $_SESSION['tipo']);
    ?>
<?php endif; ?>

<?php
// Verifica si hay contenido para incluir la vista específica
if (isset($content)) {
    include $content;
}

// Incluye el pie de página
include __DIR__ . '/footer.php';
?>
