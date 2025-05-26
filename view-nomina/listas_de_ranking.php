<?php if(isset($ranking)) : ?>
    <table id="tabla-ranking">
       
    <?php foreach($ranking as $index=> $top): 
        $puesto= $index + 1;
        $nombreD=$top['nombre'];
        $puntaje=$top['puntos_ranking'];
        ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?> ---</td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
<?php endforeach; ?>
    </table>
<?php endif; ?>