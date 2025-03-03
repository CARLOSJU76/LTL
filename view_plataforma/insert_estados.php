<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cargar Estados Financieros</title>
</head>
<body>
    <h2>Cargar Estados Financieros</h2>
    <form action="index.php?action=cargar_estados" method="post" enctype="multipart/form-data">
        <input type="number" name="nualidad" min="2024" placeholder="AÑO">
        <label for="estados_pdf">Selecciona el archivo PDF:</label><br><br>
        <input type="file" name="estados_pdf" accept=".pdf" required>
        <br><br>
        <input type="submit" name="submit" value="Subir PDF">
    </form>
</body>
</html>
