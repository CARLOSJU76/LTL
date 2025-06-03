<!-- ==================================RANKING GLOBAL=================================================== -->
<div class="fondo-ranking" id="fondo-ranking">
   
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
        <?php if ($puntaje !=0): ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?></td>
            <td><?= $club ?></td>
            <td><img id="fotoD" src="fotos/<?= $foto; ?>" width="50" alt="Foto" ></td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
        <?php endif; ?>
        
<?php endforeach; ?>
        <tr>
            <td colspan="6" class="td-botones">
                <button type="button" class="xAsistencia" >Ver puntajes por Asistencias</button>
                <button type="button" class="xCompetencia">Ver puntajes por Competencias</button>
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
         <?php if ($puntaje !=0): ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?></td>
            <td><?= $club ?></td>
            <td><img id="fotoD" src="fotos/<?= $foto; ?>" width="50" alt="Foto" ></td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
            <?php endif; ?>
<?php endforeach; ?>
         <tr>
            <td colspan="6" class="td-botones">
                <button type="button" class="xAsistencia" >Ver puntajes por Asistencias</button>
                <button type="button" class="xRanking">Ver Ranking Global</button>
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
                <p style="text-align:center; letter-spacing: 0.3rem; font-weight:bold;">PUNTAJES POR ASISTENCIAS LTL</p>
            </td>
        </tr>
        <?php foreach($asistencia as $index=> $top): 
            $puesto= $index + 1;
            $nombreD=$top['nombre'];
            $club=$top['club'] ?? "Club no registrado";
            $foto=$top['foto'] ?? "IMG/LTL/no_foto.png"; // Ruta por defecto si no hay foto
            $puntaje=$top['puntos_asistencia'];
        ?>
         <?php if ($puntaje !=0): ?>
        <tr>
            <td><?= $puesto?>. </td>
            <td><?= $nombreD ?></td>
            <td><?= $club ?></td>
            <td><img id="fotoD" src="fotos/<?= $foto; ?>" width="50" alt="Foto" ></td>
            <td><?= $puntaje ?> puntos</td>
        </tr>
            <?php endif; ?>
<?php endforeach; ?>
        <tr>
            <td colspan="6" class="td-botones">
                <button type="button" class="xRanking" >Ver Ranking Global</button>
                <button type="button" class="xCompetencia">Ver puntajes por Competencias</button>
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
.td-botones {
    text-align: center;
    padding: 1rem;
}
.xRanking, .xCompetencia, .xAsistencia {
    background: linear-gradient(to bottom, #D4AF37, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
    border-radius: 3px;
    font-family:'Courier New', Courier, monospace;
    font-style: italic;
    font-size: 1rem;
    padding: 0.3rem;
   font-weight: lighter;
    color:#4A0D0D;
}
.ocultos{
    display:none;
}
 </style>
 <!-- ================================================================================================== -->
 <script>
document.addEventListener('DOMContentLoaded', function () {
    // Función para mostrar una sección y ocultar las demás
    function mostrarSeccion(idMostrar) {
    const secciones = ['fondo-ranking', 'fondo-eventos', 'fondo-asistencia'];
    secciones.forEach(id => {
        const div = document.getElementById(id);
        if (div) {
            if (id === idMostrar) {
                div.className= idMostrar;
            } else {
                div.classList.add('ocultos');
            }
        }
    });
}


    // Botones para ver asistencia
    document.querySelectorAll('.xAsistencia').forEach(boton => {
        boton.addEventListener('click', () => {
            mostrarSeccion('fondo-asistencia');
        });
    });

    // Botones para ver competencias
    document.querySelectorAll('.xCompetencia').forEach(boton => {
        boton.addEventListener('click', () => {
            mostrarSeccion('fondo-eventos');
        });
    });

    // Botones para ver ranking global
    document.querySelectorAll('.xRanking').forEach(boton => {
        boton.addEventListener('click', () => {
            mostrarSeccion('fondo-ranking');
        });
    });

    // Mostrar por defecto el ranking global
    mostrarSeccion('fondo-ranking');
});
</script>
