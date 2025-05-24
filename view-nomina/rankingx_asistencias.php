<form action="index.php?action=rankingx_asistencias" method="POST">
    <label for="idDeportista">Consulta de Deportista para ver su puntaje:</label>
    <select name="idDeportista" id="idDeportista">
           <option value="">Elija el Deportista</option>
        <?php
        foreach ($deportistas as $deportista) {
            echo "<option value='{$deportista['id']}'>{$deportista['nombres']}.{$deportista['apellidos']}</option>";
        }
        ?>
    </select>
        <button type="submit">Calcular Ranking</button>

    </form>