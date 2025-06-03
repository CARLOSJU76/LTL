<div id="fondo">
<div id="contenedor-general">
    <h2 id="titulo-consulta">Consultar Resultados en Eventos</h2>
<?php if (!empty($eventos)): ?>
    <form action="index.php?action=show_performanceByEvent" method="post" id="form_session">
        <select name="codigo_evento" id="select-consulta">
            <option value="">Seleccione el Evento que desea Analizar</option>
            <?php foreach ($eventos as $evento): ?>
                  <?php if(strtotime($evento['fecha_Evento']) < strtotime($fechaA)):?>
                <option value="<?php echo $evento['codigo']; ?>"><?php echo $evento['nombre_Evento']  ?></option>
                    <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ver Resultados del Evento" id="submit-consulta">
    </form>
    <?php elseif (isset($performances) && !empty($performances)): ?>
    <div id="contenedor_table"> 
        <h2 style="color:gold;">Resultados del evento:</h2>
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
        <form action="index.php?" method="get" id="formulario">
            <input type="hidden" name="user_email" id="user_email_input"> <!-- Input oculto para el email -->
            <button id="boton_volver" type="submit" name="action" value="show_performanceByEvent">Hacer otra consulta</button>
        </form>
    </div>
    <?php elseif (isset($performances['success']) && !$performances['success']): ?>
        <p style="color: orange; font-style: italic;"><?= htmlspecialchars($performances['msg']) ?></p>
    <?php else: ?>
            <p style="color: orange; font-style: italic;">No se encontraron registros para este evento</p>
<?php endif; ?>
</div>
</div>
<!-- ================================================================================================================ -->

<style>

    #fondo{
        width: 100%;
        height: 30rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding:2rem;

        background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;
    }
    #contenedor-general{
        width: 70%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color:#4A0D0D;
        padding: 1rem;
        border: 1px solid gold;
        border-radius: 3px;
    }
    #titulo-consulta{
        color: gold;
        font-weight: lighter;
    }
    #select-consulta{
        font-size: 1rem;
        padding:0.5rem;
    }
    #submit-consulta{
        font-size:1rem;
        font-style: italic;
        padding:0.5rem;
        background-color: transparent;
        border: 1px solid gold;
        border-radius: 3px;
        color: gold;


    }
    #contenedor_table {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
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
        background-color: #A97474;
    }
    tr:nth-child(odd) {
    background-color: #ffffff; /* color para filas impares */
}

    tr:hover {
        background-color: #FAF3D1;
    }

    th {
        font-weight: bold;
        color: #4A0D0D;
    }
    #boton_volver{
    margin-top: 1rem;
     background-color: #4A0D0D;
    color:#D4AF37;
    border: #D4AF37 solid 1px;
    font-style: italic;
    font-size: 1rem;
    border-radius: 3px;
    padding: 0.4rem;
}
.delete-boton:hover, #boton_volver:hover, .form-boton:hover{
    background-color: #d4af37;
    color:#4A0D0D;
    border: #4A0D0D;
}
</style>
    