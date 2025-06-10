<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div id="fondo-test">
    <form id="formulario-consulta" method="POST" action="index.php?action=getResultadosPruebasXDeportista">
        <h3 style="color:#842029; font-style:italic;">Consultar Resultados de Pruebas Físicas</h3>

        <!-- Seleccionar deportista -->
        <label for="deportista_id">Deportista:</label>
        <select name="deportista_id" id="deportista_id" required>
            <option value="">Seleccione un deportista</option>
            <?php foreach ($deportistas as $deportista): ?>
                <option value="<?= htmlspecialchars($deportista['id']) ?>">
                    <?= htmlspecialchars($deportista['nombres'] . ' ' . $deportista['apellidos']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Seleccionar prueba -->
        <label for="prueba_id">Tipo de Prueba:</label>
        <select name="prueba_id" id="prueba_id" required>
            <option value="">Seleccione una prueba</option>
            <?php foreach ($pruebas as $prueba): ?>
                <option value="<?= htmlspecialchars($prueba['id']) ?>">
                    <?= htmlspecialchars($prueba['nombre_prueba']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Botón de envío -->
        <input type="submit" id="consultar-btn" value="Consultar">
    </form>

    <?php if (isset($resultado) && $resultado['tipo'] === 'success' && !empty($resultado['data'])): ?>
        <div class="resultados-box">
            <h4>Resultados</h4>
            <table>
                <thead>
                    <tr>
                        <th>Deportista</th>
                        <th>Prueba</th>
                        <th>Resultado</th>
                        <th>Unidades</th>
                        <th>Fecha</th>
                        <th>Entrenador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado['data'] as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['nombreD'] . ' ' . $fila['apellidoD']) ?></td>
                            <td><?= htmlspecialchars($fila['prueba']) ?></td>
                            <td><?= htmlspecialchars($fila['resultado']) ?></td>
                            <td><?= htmlspecialchars($fila['unidades']) ?></td>
                            <td><?= htmlspecialchars($fila['fecha']) ?></td>
                            <td><?= htmlspecialchars($fila['nombreE'] . ' ' . $fila['apellidoE']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Gráfica de progreso -->
        <div class="grafica-box">
            <h4>Progreso en el tiempo</h4>
            <canvas id="graficoProgreso" height="50"></canvas>
        </div>
<!-- ========================================================================================================= -->

<!-- ========================================================================================================= -->


        <?php
        // ✅ Preparar datos para gráfico
        $fechas = array_reverse(array_column($resultado['data'], 'fecha'));
        $resultadosData = array_reverse(array_map('floatval', array_column($resultado['data'], 'resultado')));
        ?>
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const fechas = <?= json_encode($fechas) ?>;
    const resultados = <?= json_encode($resultadosData) ?>;
    console.log("Fechas:", fechas);
    console.log("Resultados:", resultados);

    const ctx = document.getElementById('graficoProgreso').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: 'Resultado en el tiempo',
                data: resultados,
                backgroundColor: 'rgba(132, 32, 41, 0.2)',
                borderColor: 'rgba(132, 32, 41, 1)',
                borderWidth: 2,
                pointBackgroundColor: '#842029',
                pointRadius: 5,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
</script>

    <?php elseif (isset($resultado) && $resultado['tipo'] === 'error'): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($resultado['msg']) ?></div>
    <?php endif; ?>
</div>

<!-- Chart.js CDN -->


<!-- ESTILOS -->
<style>
    #fondo-test {
        background-image: url('./IMG/LTL/mat.jpg');
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #formulario-consulta {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 6px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 3rem;
        padding: 2rem;
    }

    label {
        color: #842029;
        font-style: italic;
        letter-spacing: 0.3rem;
        margin-top: 1rem;
    }

    select {
        width: 70%;
        padding: 0.3rem;
        border-radius: 4px;
        border: 1px solid #842029;
        font-style: italic;
        text-align: center;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    #consultar-btn {
        width: 60%;
        background-color: transparent;
        color: black;
        border: 1px solid #842029;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
        margin-top: 1rem;
        font-style: italic;
        letter-spacing: 0.3rem;
    }

    #consultar-btn:hover {
        background-color: green;
        color: #f8d7da;
    }

    .resultados-box, .grafica-box {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 6px;
        padding: 2rem;
        width: 90%;
        max-width: 800px;
        margin: 1.5rem auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
        font-size: 0.9rem;
    }

    th, td {
        border: 1px solid #842029;
        padding: 0.5rem;
        font-style: italic;
    }

    th {
        background-color: #f8d7da;
        color: #842029;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
        padding: 12px;
        border: 1px solid #f5c2c7;
        border-radius: 5px;
        margin: 1rem;
        text-align: center;
        width: 80%;
    }

    canvas#graficoProgreso {
        max-width: 100%;
        height: 300px;
    }
</style>
