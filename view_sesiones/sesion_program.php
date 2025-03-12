<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php?action=schedule_session" method="post">
        <select name="id_entrenador">
            <option value="">Elija un entrenador de la lista</option>

        </select>
        <select name="id_lugar">
            <option value="">Elija un Sitio de Entrenamiento</option>
        
        </select>
        <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d'); ?>" placeholder="fecha del evento" class="form-control" required>

        <label for="fecha" id="label-fecha">Fije fecha del Evento</label>
    </form>
</body>
</html>