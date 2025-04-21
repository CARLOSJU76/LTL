<div id="contenedor-general">
<?php if (!empty($deportistas)): ?>
    <form action="index.php?action=show_performanceByAthlete" method="post" id="form_session">
        <select name="email">
            <option value="">Seleccione el Deportista</option>
            <?php foreach ($deportistas as $depor): ?>
                <option value="<?php echo $depor['email']; ?>"> <?php echo $depor['nombres']?> <?php echo $depor['apellidos']?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ver Resultados del Deportista" id="submit">
    </form>
<?php elseif (!empty($performances)): ?>
    <div id="contenedor_table"> 
        <h2>Actuaciones de <?php echo $performances[0]['nombreD'] ." ". $performances[0]['apellidoD']?>:</h2>
        <table>
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Modalidad</th>
                    <th>División de Peso</th>
                    <th>Posición</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($performances as $per): ?>
                <tr>
                    <td> <?=$per['nombre_Evento']?></td>
                    <td> <?=$per['modalidad']?></td>
                    <td> <?=$per['division']?></td>
                    <td> <?=$per['posicion']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <?php else: ?>
            <p style="color: orange; font-style: italic;">No se encontraron deportistas</p>
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
    