<div class="container" id="container_general">

<?php if(isset($eventos) && count($eventos)>0):?>
    <h2>Eventos Finalizados</h2>
    <table class="table table-bordered" id="tabla-eventos">
        <thead>
            <tr>
                <th>Tipo de Evento</th>                    
                <th>Nombre del Evento</th>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Categoría</th>
              
            </tr>
        </thead>
        <tbody>
        <?php foreach($eventos as $event): ?>
            <tr>
                <td><?=$event['tipoEv']?></td>
                <td><?=$event['nombreEv']?></td>                   
                <td><?=$event['fechaEv']?></td>
                <td><?=$event['paisEv'].'/'.$event['dptoEv'].'/'.$event['ciudadEv']?></td>
                <td><?=$event['cateEv']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif(isset($eventos)):?>
    <p>No se encontraron eventos</p>
<?php endif; ?>

<!-- ================================================================================================================ -->


</div>

<!-- ================================================================================================= -->
<link rel="stylesheet" href="./CSS/club_manage.css">
<link rel="stylesheet" href="./CSS/listar_repre.css">
<style>
    body{
        background-image: url('./IMG/LTL/mat.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;

        display: flex
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #boton_submit{ 
        background: linear-gradient(to bottom, #ffd700, white);
        box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
        border-radius: 5px;
        font-family:'Courier New', Courier, monospace;
        font-size: 1.2vw;
        font-weight: bold;
        color:#4A0D0D;
    }
    #head-inser_club{
        background-color: #7A1F1F;
    }
    h2{
        font-family:'Courier New', Courier, monospace;
        font-size: 2vw;
        color:white;
    }
    label{
        color:white;
        font-family:'Courier New', Courier, monospace;
        width: 100%;
    }
    #head-inser1, #head-inser2,#head-inser3,#head-inser4{
        background-color: #4A0D0D;
        font-family:'Courier New', Courier, monospace;
        font-size: 1vw;
    }
    #container_general{
        overflow: auto;
        width: 90%;
        background-color:  #4A0D0D;
        border: gold 1px solid;
        border-radius: 3px;
        margin:3rem;
    }
    #tabla-eventos{
      color: black;
      font-family: 'Courier New', Courier, monospace;
      font-size: 0.8rem;
      font-style: italic;
    }
</style>
<script>
    // Función para confirmar si el usuario desea borrar el evento
    function confirmDelete() {
        return confirm("¿Estás seguro de que deseas borrar este evento?");
    }
</script>
