<div id="contenedor-general">
<?php if (!empty($eventos)): ?>
    <form action="index.php?action=show_performanceByEvent" method="post" id="form_session">
        <select name="codigo_evento">
            <option value="">Seleccione el Evento que desea Analizar</option>
            <?php foreach ($eventos as $evento): ?>
                <option value="<?php echo $evento['codigo']; ?>"><?php echo $evento['nombre_Evento']  ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ver Resultados del Evento" id="submit">
    </form>
    <?php elseif (isset($performances) && !empty($performances)): ?>
    <div id="contenedor_table"> 
        <h2>Resultados del evento:</h2>
        <table>
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Deportista</th>
                    <th>Modalidad</th>
                    <th>División de Peso</th>
                    <th>Posición</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($performances as $per): ?>
                <tr>
                    <td> <?=$per['nombre_Evento']?></td>
                    <td> <?=$per['nombreD']?> <?=$per['apellidoD']?></td>
                    <td> <?=$per['modalidad']?></td>
                    <td> <?=$per['division']?></td>
                    <td> <?=$per['posicion']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php elseif (isset($performances['success']) && !$performances['success']): ?>
        <p style="color: orange; font-style: italic;"><?= htmlspecialchars($performances['msg']) ?></p>
    <?php else: ?>
            <p style="color: orange; font-style: italic;">No se encontraron registros para este evento</p>
<?php endif; ?>
</div>

<style>
    #contenedor_table {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #contenedor_table h2 {
        margin-bottom: 15px;
        font-size: 1.2rem;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px 12px;
        text-align: left;
    }

    thead {
        background-color: #f5f5f5;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #eef;
    }

    th {
        font-weight: bold;
        color: #222;
    }
</style>
    