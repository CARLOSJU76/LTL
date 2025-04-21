<?php
// Establece el título de la página, si no se define desde la vista, se usa 'Mi sitio'
$title = $title ?? 'Mi sitio'; 
include __DIR__ . '/header.php';
?>

<?php if (isset($msg) && isset($tipo)): ?>
    <div style="padding:1rem; margin-bottom:1rem; border-radius:5px; background-color:
        <?= $tipo === 'success' ? '#d4edda' : ($tipo === 'error' ? '#f8d7da' : ($tipo === 'warning' ? '#fff3cd' : '#ccc')) ?>;">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<?php
// Verifica si hay contenido para incluir la vista específica
if (isset($content)) {
    include $content;
}

// Incluye el pie de página
include __DIR__ . '/footer.php';
?>
