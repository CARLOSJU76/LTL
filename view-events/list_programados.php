
<div id="fondo">
<div class="container" id="container-general" >

<?php if(isset($eventos) && count($eventos)>0):?>
        <h2>Eventos Programados</h2>
        <table class="table table-bordered" id="tabla-programados">
            <thead>
                <tr>
                    <th>Tipo de Evento</th>
                    <th>Nombre del Evento</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Categoría</th>
                    <th>Acciones</th> <!-- Columna para los botones de acción -->
                </tr>
            </thead>
            <tbody>
            <?php foreach($eventos as $event):
            // Compara las fechas correctamente sin el punto y coma al final del if
                if(strtotime($event['fechaEv']) > strtotime($fechaA)):
            ?>
                <tr>
                    <td><?=$event['tipoEv']?></td>
                    <td><?=$event['nombreEv']?></td>
                    <td><?=$event['fechaEv']?></td>
                    <td><?=$event['paisEv'].'/'.$event['dptoEv'].'/'.$event['ciudadEv']?></td>
                    <td><?=$event['cateEv']?></td>
                    <td>
                        <!-- Formulario para actualizar -->
                        <form action="index.php?action=update_event" method="get" class="form-botones" style="display:inline;">
                            <input type="hidden" name="id_evento" value="<?= $event['id_ev'] ?>">
                            <button type="submit" name="action" value="update_event" class="botones">Actualizar</button>
                        </form>
                        <!-- Formulario para eliminar -->
                        <form action="index.php?action=delete_event" method="post" class="form-botones" style="display:inline;"  onsubmit="return confirmDelete()">
                            <input type="hidden" name="id_evento" value="<?= $event['id_ev'] ?>">
                            <button type="submit" name="action" value="delete_event" class="botones">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endif; // Asegúrate de usar endif para cerrar el bloque del if ?>
                <?php endforeach; ?>
            </tbody>
        </table>
            <?php elseif(isset($eventos)):?>
                <p style="color:gold; font-style: italic;">No se encontraron coincidencias</p>
            <?php endif;?>
<!-- ================================================================================================================ -->
        <form action="index.php?action=search_event" method="get" id="form_buscar_club">
            <input type="hidden" name="action" value="search_event">
            <input type="hidden" name="viene_de" value="programados">
            <select name="id_evento" id="id_evento" class="form-select" required>
                <option value="">Elija el Evento</option>
                    <?php
                       include_once './controller/EventController.php';
                        $objeto= new EventController(); 
                        $arrayEv= $objeto->listEventos();

                        foreach($arrayEv as $event1){
                             if(strtotime($event1['fechaEv']) > strtotime($fechaA)){
                                echo"<option value='".htmlspecialchars($event1['id_ev'])."'>
                                        ". htmlspecialchars($event1['nombreEv']) ."
                                    </option>";
                            }
                        }
                    ?>
            </select><br>
            <input type="submit" value="Buscar el Evento" id="buscar_club">
        </form>
        <label for="id_dep">Seleccione el Evento que desea consultar.</label>
</div>
</div>
<!-- ========================================================================================================= -->

<style>
        #fondo{
            width: 95%;
            height: 30rem;
            padding:3rem;
            background-image: url('./IMG/LTL/mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

.container, .form-select{
    border: 1px solid gold ;
    padding-top:0;
    width: 95%;
}
 .form-select{
    width: 58%;
    height: 100%;
    margin-bottom: 1%;
    text-justify: center;
    font-family:'Courier New', Courier, monospace;
    font-size: 1.2vw;

}
h2{
    font-family:'Courier New', Courier, monospace;
    font-size: 2vw;
    color:white;
}
#form_buscar_club{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    width:100%;
    padding:0;
    height: 2rem;

   }
label{
    color:white;
    font-family:'Courier New', Courier, monospace;
    width: 100%;
}
#buscar_club{
    width:49%;
    height: 100%;
    background: linear-gradient(to bottom, #ffd700, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5);
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1vw;
    font-weight: bold;
    color:#4A0D0D;
    border:none;
}

#container-general{
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 95%;
    background-color: #4A0D0D;
    margin-top:3rem;
    padding: 1rem;
    border-radius: 3px;
}

.table {
    width: 100%;
    background-color: white;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.table th {
    background-color:#4A0D0D; /* Verde militar */
    color: white;
    border-radius: 7px;
}

.table th, .table td {
    text-align: center;
    padding: 15px;
    font-size: 1rem;
}
/* =============================================================================== */

.btn-custom {
    background-color: #7A1F1F;;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border: none;
}

.btn-custom:hover {
    background-color: #3c421c;
}

form {
    margin-top: 20px;
}
.form-control, .form-select{
    width: 80%;
    font-size: small;
    margin:0;
}

.botones{  
        
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:'Courier New', Courier, monospace;
            font-size: 1vw;
            color:#4A0D0D;
           height:100%;
}
</style>
<script>
    // Función para confirmar si el usuario desea borrar el evento
    function confirmDelete() {
        return confirm("¿Estás seguro de que deseas borrar este evento?");
    }
</script>
