<div id="contenedor-general">
<?php if (!empty($deportistas)): ?>
    <form action="index.php?action=list_sesion_by_sport" method="post" id="form_session">
        <select name="id_deportista">
            <option value="">Selecciona un deportista</option>
            <?php foreach ($deportistas as $deportista): ?>
                <option value="<?php echo $deportista['id']; ?>"><?php echo $deportista['nombres'] . ' ' . $deportista['apellidos']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Buscar Sesiones" id="submit">
    </form>
<?php elseif (empty($deportistas)& (!empty($sesiones))): ?>
    <div id="contenedor_table"> 
        <h2>Sesiones encontradas:</h2>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th>Estímulos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sesiones as $sesion): ?>
                <tr>
                    <td> <?=$sesion['fecha']?></td>
                    <td> <?=$sesion['hora']?></td>
                    <td> <?=$sesion['lugar']?></td>
                    <td> <?=$sesion['nombreE']?> <?=$sesion['apellidoE']?></td>
                    
                    <td> <?=$sesion['estimulo']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <?php else: ?>
            <p style="color: orange; font-style: italic;">No se encontraron sesiones para este deportista</p>
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
    