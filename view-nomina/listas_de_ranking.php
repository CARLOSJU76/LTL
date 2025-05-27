<!-- ==================================RANKING GLOBAL=================================================== -->
<div class="fondo-ranking">
<?php if(isset($ranking)) : ?>
    <table id="tabla-ranking">
        <tr>
            <td colspan="6">
                <p style="text-align:center; letter-spacing: 0.3rem; font-weight:bold;">RANKING LOCAL LTL</p>
            </td>
        </tr>
        <?php foreach($ranking as $index=> $top): 
            $puesto= $index + 1;
            $nombreD=$top['nombre'];
            $club=$top['club'] ?? "Club no registrado";
            $foto=$top['foto'] ?? "IMG/LTL/no_foto.png"; // Ruta por defecto si no hay foto
            $puntaje=$top['puntos_ranking'];
        ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?></td>
            <td><?= $club ?></td>
            <td><img id="fotoD" src="fotos/<?= $foto; ?>" width="50" alt="Foto" ></td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
        
<?php endforeach; ?>
        <tr>
            <td colspan="6">
                <button type="button" id="xAsistencia" >Ver puntajes por Asistencias</button>
                <button type="button" id="xCompetencia">Ver puntajes por Competencias</button>
            </td>
        </tr>
    </table>
<?php endif; ?>
</div>
<!-- ===========================RANGING EVENTOS========================================================= -->
<div class="ocultos" id="fondo-eventos">
<?php if(isset($eventos)) : ?>
    <table id="tabla-eventos">
        <tr>
            <td colspan="6">
                <p style="text-align:center; letter-spacing: 0.3rem; font-weight:bold;">PUNTAJES EN COMPETENCIAS LTL</p>
            </td>
        </tr>
        <?php foreach($eventos as $index=> $top): 
            $puesto= $index + 1;
            $nombreD=$top['nombre'];
            $club=$top['club'] ?? "Club no registrado";
            $foto=$top['foto'] ?? "IMG/LTL/no_foto.png"; // Ruta por defecto si no hay foto
            $puntaje=$top['puntos_eventos'];
        ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?></td>
            <td><?= $club ?></td>
            <td><img id="fotoD" src="fotos/<?= $foto; ?>" width="50" alt="Foto" ></td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
       
<?php endforeach; ?>
         <tr>
            <td colspan="6">
                <button type="button" id="xAsistencia" >Ver puntajes por Asistencias</button>
                <button type="button" id="xCompetencia">Ver Ranking Global</button>
            </td>
        </tr>
    </table>
<?php endif; ?>
</div>
<!-- ========================RANKING POR ASISTENCIAS==================================================== -->
<div class="ocultos" id="fondo-asistencia">
<?php if(isset($asistencia)) : ?>
    <table id="tabla-asistencia">
        <tr>
            <td colspan="6">
                <p style="text-align:center; letter-spacing: 0.3rem; font-weight:bold;">PUNTAJES POR COMPETENCIAS LTL</p>
            </td>
        </tr>
        <?php foreach($asistencia as $index=> $top): 
            $puesto= $index + 1;
            $nombreD=$top['nombre'];
            $club=$top['club'] ?? "Club no registrado";
            $foto=$top['foto'] ?? "IMG/LTL/no_foto.png"; // Ruta por defecto si no hay foto
            $puntaje=$top['puntos_asistencia'];
        ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?></td>
            <td><?= $club ?></td>
            <td><img id="fotoD" src="fotos/<?= $foto; ?>" width="50" alt="Foto" ></td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
        
<?php endforeach; ?>
        <tr>
            <td colspan="6">
                <button type="button" id="xAsistencia" >Ver Ranking Global</button>
                <button type="button" id="xCompetencia">Ver puntajes por Competencias</button>
            </td>
        </tr>
    </table>
<?php endif; ?>
</div>
<!-- ===================================ESTILOS========================================================= -->
 <style>
  .fondo-ranking, .fondo-eventos, .fondo-asistencia {
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
#tabla-ranking, #tabla-eventos, #tabla-asistencia {
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
#tabla-ranking td,
#tabla-eventos th,
#tabla-eventos td,
#tabla-asistencia th,
#tabla-asistencia td {
    padding: 0.6rem 1rem;
    border: 1px solid #D4AF37;
    vertical-align: middle;
}

#tabla-ranking tr:nth-child(even) {
    background-color: #3E1010; /* fila alterna para contraste */
}
#tabla-eventos tr:nth-child(even) {
    background-color: #3E1010; /* fila alterna para contraste */
}
#tabla-asistencia tr:nth-child(even) {
    background-color: #3E1010; /* fila alterna para contraste */
}
#fotoD {
    
    border-radius: 50%; /* Hace que la imagen sea circular */
    border: 3px solid #D4AF37; /* Borde dorado alrededor de la imagen */
    display: block; 
    margin: 0 auto;
}
.ocultos{
    display:none;
}
 </style>
 <!-- ================================================================================================== -->
  <script>
    document.getElementById('xAsistencia').addEventListener('click', function() {
       documento.getElementById('fondo-asistencia').className = "fondo-asistencia";
        document.getElementById('fondo-eventos').className = "ocultos";
    });

    document.getElementById('xCompetencia').addEventListener('click', function() {
        document.querySelector('.fondo-asistencia').style.display = 'none';
        document.querySelector('.fondo-ranking').style.display = 'block';
    });