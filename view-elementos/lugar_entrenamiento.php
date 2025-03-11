<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros de Entrenamiento</title>
</head>
<body>
    <form actio="index.php?action=insert_lugar" method="post">
            <input type="text" name="lugar" placeholder="Escriba el nombre del lugar">

            <div id="menu">
<!-- ============================================================================================================================= -->
                <div id="uno">
                    <select id="pais" id="select-ubi1" class="form-select" name="pais" required>
                        <option value="">Elige país</option>   
                    </select>
                </div>
<!-- ============================================================================================================================= -->
                <div id="dos">
                    <select id="departamento" id="select-ubi2" class="form-select" name="departamento" style="display:none;" required>
                        <option value="">Elije departamento</option>
                    </select>
                </div>
<!-- ============================================================================================================================== -->
                <div id="tres">
                    <select id="ciudad" name="ciudad" id="select-ubi3" class="form-select" style="display:none;" required>
                        <option value="">Elije ciudad</option>
                    </select>
                </div>
<!-- =============================================================================================================================== -->
            </div>

    </form>

    <script src="JS/co-dpt-ci.js"></script>
</body>
</html>