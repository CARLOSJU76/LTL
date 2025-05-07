<div id="fondo-clubes">
<div class="container mt-4" id="contenedor-general" >
    <?php if(isset($arrayC) && count($arrayC)>0):?>
    <h2>Clubes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th id="head-inser1">Club</th>
                <th id="head-inser2">Representante</th>
                <th id="head-inser3">Documento</th>
                <th id="head-inser4">Fecha de Conformación</th>
                <th id="head-inser4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arrayC as $cl): ?>
            <tr>
                <td style="font-size: 0.7rem;"><?=$cl['nombreClub']?></td>
                <td style="font-size: 0.7rem;"><?=$cl['nombreR'] . ' ' . $cl['apellidoR']?></td>
                <td style="font-size: 0.7rem;"><?=$cl['documento']?></td>
                <td style="font-size: 0.7rem;"><?=$cl['fecha']?></td>
                <td class="td-botones">
                    <!--  -->
                    <form action="index.php?action=update_club" method="get" class="form-botones" style="display:inline;">
                        <input type="hidden" name="codigo_club" value="<?= $cl['club_id'] ?>">
                        <button type="submit" id="boton-clubes1" name="action" value="update_club" >Actualizar</button>
                    </form>
                    <!-- Formulario para eliminar -->
                    <form action="index.php?action=delete_club" method="post" class="form-botones" style="display:inline;"  onsubmit="return confirmDelete()">
                        <input type="hidden" name="codigo_club" value="<?= $cl['club_id'] ?>">
                        <button type="submit" id="boton-clubes2" name="action" value="delete_club" >Borrar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?php elseif(isset($arrayC)):?>
            <p>No se encontraron usuarios con ese nombre</p>

        <?php endif;?>
    <!-- ================================================================================================================ -->

    <form action="index.php?action=search_club" method="get" id="form_buscar_club">
        <input type="hidden" name="action" value="search_club">
        <select name="codigo_club" id="codigo_club" class="form-select" required>
            <option value="">Elija el Club</option>
            <?php
                  include_once './controller/ClubController.php';
                  $clubCon= new ClubController();
                  $arrayClub= $clubCon->getNombreClubes();

                foreach($arrayClub as $cl1){
                    echo"<option value='" .htmlspecialchars($cl1['codigo'])."'>".
                        htmlspecialchars($cl1['nombreClub'])."
                        </option>";
                }
            ?>
        </select><br>
        <input type="submit" value="Buscar" id="buscar_club">        
    </form>
    <label for="codigo_club" style="color:#D4AF37; font-style: italic;">Elija el Club que desea Analizar</label>
    <!-- ========================================================================================================= -->
</div>
</div>
<!-- ===================================================================================================== -->
<link rel="stylesheet" href="./CSS/club_manage.css">
<link rel="stylesheet" href="./CSS/listar_clubes.css">
<style>
        
    #fondo-clubes{
        background-image: url('./IMG/LTL/renteria.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    #contenedor-general{
        margin:2rem;
        background-color: #4A0D0D;
        border: #D4AF37 solid 1px;
    }
    #boton-clubes1, #boton-clubes2{
        width: 3rem;
        border: #4A0D0D solid 1px;
        background-color: transparent;
        border-radius: 3px;
        font-size: 0.6rem;
        color:#4A0D0D;
        padding:0.3rem;
    }
</style>