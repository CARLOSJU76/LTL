<div id="fondo-lista">
<div class="form-insert">

    <?php if(isset($sesiones) && count($sesiones)>0):?>
        <h2 style="font-size: 1.2rem; font-weight: 100;">Sesiones encontradas:</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sesiones as $sesion): ?>
                <tr>
                   
                    <td> <?=$sesion['id']?></td>
                    <td class="lugar"> <?=$sesion['sitio']?></td>
                    <td> <?=$sesion['nombreE']?> <?= $sesion['apellidoE']?></td>
                    <td> <?=$sesion['fecha']?></td>
                    <td> <?=$sesion['hora']?></td>
                    <td>
                    <form action="index.php?action=delete_session" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?=$sesion['id']?>">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
        <?php elseif(isset($sesiones)):?>
            <p style="color: yellow; font-style: italic;">No tienes sesiones programadas</p>

        <?php endif;?> 
    </div>
</div>
<!-- ============================================================================================================================ -->
 <style>
   
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}

        #fondo-lista{
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
    }
    .form-insert{
        width: 80%;
       
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color: #4A0D0D;
        border: solid gold 2px;
       margin:4rem;
        padding:2%;
         font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        color:white;
    }
    #uno,#dos,#tres{
        width: 33;
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
        width: 40%;
    }
    td, th{
        padding: 1%;
        font-size:1vw;
        border:solid gold 1px;


    }
    .lugarE{
        width: 55%;
    }
    table{    
        width: 100%;
        border: solid gold 1px;
    }
    #formulario{
        margin:5%;
    }
    .lugar{
        width: 40%;
    }
    .boton-sub{
        width: 98%;
        background-color: transparent;
        border: solid gold 0.1rem;
        font-size:0.8rem;
        border-radius: 3px;
        margin:1rem;
      
        padding:0.3rem;
        color:gold;
        font-family: 'Courier New', Courier, monospace;
        font-style: italic;
    }
    #boton1{
        width: 35%;
    }
    #boton2{
        width: 65%;
    }
</style>