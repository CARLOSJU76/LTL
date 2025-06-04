
<script src="JS/jquery-3.7.1.min.js"></script>
<!-- ================================================================================================= -->
<div id="fondo-lugar">
<div class="form-insert" id="form-uno">
    <?php if(isset($lugares) && count($lugares)>0):?>
        <h2 style="color: #D4AF37; font-style:italic;">Sitios de Entrenamiento</h2>
        <table>
            <thead>
                <tr style="color: #D4AF37; font-style:italic;">
                    <th>Nombre/Dirección</th>
                    <th>Pais</th>
                    <th>Dpto/Estado</th>
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lugares as $lugar): ?>
                <tr style="color: #D4AF37; font-style:italic; font-weight: lighter;">
                    <td class="lugarE">*<?=$lugar['lugar']?></td>
                    <td>- <?=$lugar['pais']?></td>
                    <td>- <?=$lugar['dpto']?></td>
                    <td>- <?=$lugar['ciudad']?></td>
        
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($deportistas)):?>
            <p style="color: #D4AF37; font-style:italic;">No se encontraron lugares con ese nombre</p>

        <?php endif;?>
</div> 
<!-- ================================================================================================================================= -->
    <form action="index.php?action=insert_lugar" method="post" class="form-insert">
        <h2 style="color: #D4AF37; font-style:italic;" >Inserción lugares de Entrenamiento</h2>
        <input type="text" name="lugar" id="input-lugar" placeholder="Escriba el nombre del lugar" required minlength="15">
            <div id="menu-lugar">
<!-- ============================================================================================================================= -->
                <div id="uno">
                    <select id="pais"  class="form-select" name="pais" required>
                        <option value="">Elige país</option>   
                    </select>
                </div>
<!-- ============================================================================================================================= -->
                <div id="dos">
                    <select id="departamento"  class="form-select" name="dpto" style="display:none;" required>
                        <option value="">Elije departamento</option>
                    </select>
                </div>
<!-- ============================================================================================================================== -->
                <div id="tres">
                    <select id="ciudad" name="ciudad"  class="form-select" style="display:none;" required>
                        <option value="">Elije ciudad</option>
                    </select>
                </div>
<!-- =============================================================================================================================== -->
            </div>
            <button type="submit" class="boton-lugares">Guardar Datos</button>
    </form>
<!-- ================================================================================================================================ -->

<form action="index.php?action=delete_lugar" method="post" class="form-insert">
    <input type="hidden" name="action" value="delete_lugar">

            <h2 style="color: #D4AF37; font-style:italic;">Borrar lugar de Entrenamiento</h2>
        
        <select name="id_lugar" id="id_lugar" class="form-select" required>
            <option value="">Elija el Sitio que desea excluir de la base de datos</option>
            <?php
                  
                foreach($lugares as $lugar){
                    echo"<option value='".htmlspecialchars($lugar['id'])."'>".
                    htmlspecialchars($lugar['lugar']) .
                    
                    "</option>";
                }
            ?>
        </select>
        <input type="submit" value="Borrar" class="boton-lugares">        
    </form>
</div>
    
<!-- ======================================================================================== -->
<style>
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}

    #fondo-lugar{
        width: 100%;
        background-image: url('./IMG/LTL/renteria.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #form-uno{
        margin-top:2rem;
    }
    #menu-lugar{
        display: flex;
        flex-direction: row;
        width:80%;
        justify-content: space-between;
        padding:0;
        border: solid gold 1px;
        border-radius: 3px;
        margin-top: 3%;
        
    }
    #input-lugar{
        border: #D4AF37 1px solid;
        border-radius: 3px;
        font-size: 1.2rem;
        background-color: #DCDCDC;
        padding: 0.4rem;
    }
    .form-select{
        font-size: 1rem;
        padding:0.3rem;
        background-color: #DCDCDC;
    }
    .form-insert{
        width: 60%;
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color: #4A0D0D;
        border: solid gold 2px;
        margin-bottom: 3%;
        padding:2%;
    }
    #tabla-lugares{
        color: #D4AF37;
    }
    #uno,#dos,#tres{
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 33%;
        margin-top: 3%;
        margin-bottom: 3%;
       
      
    }
    input{
        width: 80%;
       font-size: 1.3vw;
       font-style: italic;
       padding:2%;
    }
    option{
        font-size: 0.8vw;
        font-style: italic;
    }
    select{
        font-size: 1vw;
        font-style:italic;
        padding: 1%;
    }
    .boton-lugares{
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 3px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: italic;
            font-size: 1.2rem;
            font-weight: bold;
            color:#4A0D0D;
            width:15rem;
            padding: 0.3rem;
            margin-top:1rem;
        }
    td{
        width: 15%;
        padding: 2%;
    }
    .lugarE{
        width: 55%;
        color: #D4AF37;
    }
    table{
    
        width: 100%;
        color: #D4AF37;
        font-weight: lighter;
    }
</style>
<!-- ===================================================================================================== -->
<script src="JS/co-dpt-ci.js"></script>