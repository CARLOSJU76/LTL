<?php
if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

$usuario=$_SESSION['user_id'] ?? '';
$email=$_SESSION['email'] ?? '';
include_once('./controller/DeportistaController.php');
include_once('./controller/ElementosController.php');
$depoControl= new DeportistaController();
$eventControl= new EventController();
$datos=$depoControl->get_id_by_email($email);
$id=$datos['id'];
$nombre=$datos['nombres'];
$apellido=$datos['apellidos'];

$resultado = $eventControl->getMyPerformances($email);
$performances= $resultado['data'] ?? [];
?>
<!-- ============================================================================================================ -->
<div id="fondo">
<div id="contenedor-general">
   
<!-- ============================================================================================================ -->
<?php if (!empty($performances)): ?>
    <div id="contenedor_table">
        <h2 style=" color:#D4AF37; font-style:italic; font-weight: lighter;"> <?php echo $nombre . " " . $apellido?>, tus competencias:</h2>
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
    <?php elseif (isset($performances) && ($performances)==""): ?>
            <p style="color: orange; font-style: italic;">No se encontraron registros para este evento</p>
<?php endif; ?>
  
</div>
</div>
<!-- ============================================================================================================ -->
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
    h2{
        color:#D4AF37; font-style:italic; font-weight: lighter;
    }
    #form-session{
        display: flex;
        flex-direction: row;
        width: 60%;
    }
    #select-consulta{
        font-size: 1rem;
        padding:0.5rem;
        width: 60%;
        margin-right: 0.3rem;
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
</style>
    