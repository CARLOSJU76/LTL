<?php
if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

$usuario=$_SESSION['user_id'] ?? '';
$email=$_SESSION['email'] ?? '';
include_once('./controller/DeportistaController.php');
include_once('./controller/ElementosController.php');
$depoControl= new DeportistaController();
$eleControl= new ElementosController();
$datos=$depoControl->get_id_by_email($email);
$id=$datos['id'];
$nombre=$datos['nombres'];
$apellido=$datos['apellidos'];

$resultado = $eleControl->getmySessions($id);
$sesiones= $resultado['data'] ?? [];
?>


<div id="contenedor-general">
   
<?php if(!empty($sesiones)): ?>
    <div id="contenedor_table"> 
        <h2><?php echo $nombre . " " . $apellido ?>, aquí están tus entrenamientos: </h2>
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
    <div id="contenedor_table">
            <p style="color: orange; font-style: italic; margin:3rem;">No se encontraron sesiones para este deportista <?php echo $email?> <?php echo $usuario?> </p>
        </div>
<?php endif; ?>
</div>

<style>
    #contenedor-general {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-image: url('./IMG/LTL/mat.jpg');
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh;
    }
    #contenedor_table {
        margin-top: 20px;
        padding: 10px;
        border: #D4AF37;
        border-radius: 5px;
        background-color:#4A0D0D;
        color: #D4AF37;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    #form-volver {
        width: 100%;
        padding:0.5rem;
        display: flex;
        justify-content: center;
    }

    #contenedor_table h2 {
        margin-bottom: 15px;
        font-size: 1.2rem;
        color:#D4AF37;
        letter-spacing: 0.3rem;
        font-style: italic;
        font-weight: lighter;

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
        color:#4A0D0D;
    }

    tr:hover {
        background-color:#D4AF37;
        color: #4A0D0D;
    }

    th {
        font-weight: bold;
        color: #222;
    }
    #form_session {
        width: 60%;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #4A0D0D;
        border: #D4AF37 solid 2px;
        border-radius:3px;
        padding:1rem;
    }
    #id_deportista {
        width: 40%;
        padding: 0.3rem;
        font-size: 1rem;
        margin-bottom: 1rem;
        border: #D4AF37 solid 2px;
        border-radius: 3px;
        font-style: italic;
        margin:1rem;
    }
    #submit-session, #boton_volver {
        width: 30%;
        background-color: transparent;
        border: #D4AF37 solid 2px;
        font-size: 1rem;
        border-radius: 3px;
        font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        color: #D4AF37;
        padding: 0.5rem;
        cursor: pointer;
    }
    #submit-session:hover, #boton_volver:hover {
        background-color: #D4AF37;
        color: #4A0D0D;
        border: #4A0D0D solid 2px;
    }   
    #boton-volver{
        width: 70%;
        background-color: transparent;
        border:#D4AF37 solid 1px;
        color:#D4AF37;
        letter-spacing: 0.3rem;
        padding:0.3rem;
        font-style: italic;
    }
    #boton-volver:hover{
        background-color: #D4AF37;
        color:#4A0D0D;
        border:#4A0D0D solid 2px;
    }
</style>
    