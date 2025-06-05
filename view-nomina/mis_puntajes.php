<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$email= $_SESSION['email'] ?? 'debes iniciar sesión!!';
include_once './controller/DeportistaController.php';
$objeto= new DeportistaController();

$depor_id= $objeto->get_id_by_email($email)['id'];
?>
<div id="fondo-ranking">

    <form id="rankingForm" action="index.php?" method="POST">

        <?php if(isset($detalles)): ?>
            <?php if(isset($asistencias)): ?>
        
                <table id="tabla-ranking">
                    <tr>
                        <td colspan="4">
                            <p> <?php echo $deportista ?>, tuviste <?php echo $asistencias ?> asistencias, en las que obtuviste:</p>
                        </td>
                    </tr>

                        <?php foreach($detalles as $detalle): ?>
                        <?php
                        $cantidad = $detalle['cantidad'];
                        $puntaje_total = $detalle['total_puntos'];
                        $puntosxestimulo = $puntaje_total / $cantidad;
                        if ($detalle['estimulo'] == "actuación excepcional ***") {
                            $estimulo = "Actuaciones excepcionales:";
                        } elseif ($detalle['estimulo'] == "actuación muy destacada  **") {
                            $estimulo = "Actuaciones muy destacadas:";
                        } elseif ($detalle['estimulo'] == "actuación destacada  *") {
                            $estimulo = "Actuaciones destacadas:";
                        } else {
                            $estimulo = "Performances normales:";
                        }
                        ?>
                    <tr>
                        <td><?= $estimulo ?></td>
                        <td><?= $cantidad ?> </td>
                        <td> x <?= number_format($puntosxestimulo, 2) ?></td>
                        <td colspan="2"><?= $puntaje_total ?> puntos</td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4">
                            <p >Puntos por asistencias: <?= $resultado['total_eventos'] ?></p>
                        </td>
                    </tr>
            </table>
              <?php elseif(isset($eventos)): ?>
                <table id="tabla-ranking">
                    <tr>
                        <td colspan="5">
                            <p style="font-size: 0.8rem;"><?php echo $deportista ?> has participado en <?php echo $eventos?> competencias, y obtuviste los siguientes resultados:</p>
                        </td>
                    </tr>

                        <?php foreach($detalles as $detalle): ?>
                        <?php
                        $posicion = $detalle['posicion'];
                        $puntaje_total = $detalle['total_puntos'];
                        if($posicion==1){
                            $multi=4;
                        }else if($posicion==2){
                            $multi=2.5;
                        }else if($posicion==3){
                            $multi=2;
                        }else{
                            $multi=1;
                        }
                        $puntosxestimulo = $puntaje_total / $posicion;
                        if ($detalle['tipo_evento'] == "Campeonato Internacional") {
                            $t_evento = "Campeonatos Internacionales:";
                            $punto_base=20;
                        } elseif ($detalle['tipo_evento'] == "Campeonato Nacional") {
                            $t_evento = "Campeonatos Nacionales";
                            $punto_base=10;
                        } elseif ($detalle['tipo_evento'] == "Copa Colombia") {
                            $t_evento = "Copas Colombia";
                            $punto_base=8;
                        }elseif ($detalle['tipo_evento'] == "Campeonato Departamental") {
                            $t_evento = "Campeonatos Departamentales";
                            $punto_base=4;
                        }elseif ($detalle['tipo_evento'] == "Campeonato Municipal") {
                            $t_evento = "Campeonatos Municipales";
                            $punto_base=2;
                        }else {
                            $t_evento = "Intercambios";
                            $punto_base=2;
                        }
                        ?>
                    <tr>
                        <td colspan="2"> <?= $t_evento ?> </td>
                        <td> Posición: <?= $posicion ?>o.</td>
                        <td><?=$punto_base?> x <?= number_format($multi, 2) ?></td>
                        <td colspan="2"><?= $puntaje_total ?> puntos</td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5">
                            <p >Puntos por asistencias: <?= $resultado['total_eventos'] ?></p>
                        </td>
                    </tr>
            </table>
             <?php elseif(isset($ranking)): ?>
                <table id="tabla-ranking">
                    <tr>
                        <td><?= $ranking ?> </td>
                    </tr>
                    <tr>
                        <td> El Puntaje total es de <?= $detalles?> puntos.</td>
                    </tr>
                </table>
       
            <?php endif; ?>
<?php endif; ?>

            
       <input type="hidden" name="idDeportista" value="<?= htmlspecialchars($depor_id)?>">
       <input type="hidden" name="from" value="perfil_deportista">
         <label id="label-id" >Consulta tus puntajes por asistencias y eventos.</label>
        <div id="submit-buttons">
            <button type="submit" name="action" id="xasistencia" class="botones-ranking">Puntaje por Asistencias</button>
            <button type="submit" name="action" id="xeventos" class="botones-ranking">Puntaje por Eventos</button>    
            <button type="submit" name="action" id="xtotal" class="botones-ranking">Puntaje de Ranking Global</button>  
        </div>
        
        </form>
    </div>
    <!-- =================================================================================== -->
    <style>
        #fondo-ranking {
             background-image: url('./IMG/LTL/mat.jpg');
            /* background-size: cover; Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin:2rem;
        }
        #rankingForm {
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #4A0D0D;
            padding:0.5rem;
            margin:2rem;
        }
        #label-id {
            color: #D4AF37;
            font-family: 'Arial', sans-serif;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            font-style: italic;
            font-weight: lighter;
            letter-spacing: 0.2rem;
        }
        #idDeportista {
            width: 80%;
            padding: 0.4rem;
            margin: 1rem;
            margin-bottom: 0.3rem;
            border-radius: 5px;
            border: 1px solid  #D4AF37 ;
            font-style: italic;
            font-size: 1rem;
        }
        #tabla-ranking {
    width: 80%;
    margin-top: 1rem;
    border-collapse: collapse;
    background-color: #2E0909; /* fondo oscuro para la tabla */
    color: #D4AF37; /* texto dorado */
    font-family: 'Arial', sans-serif;
    font-size: 1rem;
    font-style: italic;
    text-align: left;
}

#tabla-ranking th,
#tabla-ranking td {
    padding: 0.6rem 1rem;
    border: 1px solid #D4AF37;
    vertical-align: middle;
}

#tabla-ranking tr:nth-child(even) {
    background-color: #3E1010; /* fila alterna para contraste */
}

#tabla-ranking tr:hover {
    background-color: #5E1A1A; /* hover para filas */
}
 .botones-ranking{
    margin-top: 1rem;
     background-color: #4A0D0D;
    color:#D4AF37;
    border: #D4AF37 solid 1px;
    font-style: italic;
    font-size: 1rem;
    border-radius: 3px;
    padding: 0.4rem;
}
.botones-ranking:hover{
    background-color: #d4af37;
    color:#4A0D0D;
    border: #4A0D0D;
}

    </style>
    <!-- ========================================================================================== -->
    <script>
    // Obtener el formulario
    const form = document.getElementById('rankingForm');

    // Asignar evento a cada botón
    document.getElementById('xasistencia').addEventListener('click', function () {
        form.action = 'index.php?action=rankingx_asistencias';
    });

    document.getElementById('xeventos').addEventListener('click', function () {
        form.action = 'index.php?action=rankingx_eventos';
    });

    document.getElementById('xtotal').addEventListener('click', function () {
        form.action = 'index.php?action=ranking_total';
    });
</script>