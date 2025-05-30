
<div id="fondo-session-deportista">

    <?php if(isset($sesiones)):?>
       
        <table id="table-sesion" class="table-sesion">
            <thead>
                <tr>
                    <th colspan="5" class="anuncios">Sesiones Programadas por Entrenador:</th>
                <tr>
                    <th>No.</th>
                    <th>Lugar</th>
                    <th>Entrenador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sesiones as $sesion): ?>
                <tr>
                    <td> <?=$sesion['id']?></td>
                    <td class="lugar"> <?=$sesion['sitio']?></td>
                    <td> <?=$sesion['nombreE']?></td>
                    <td> <?=$sesion['fecha']?></td>
                    <td> <?=$sesion['hora']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php elseif(isset($sesiones)):?>
            <p class="anuncios" >No se encontraron sesiones dirigidas por el entrenador</p>

        <?php endif;?>     
                                                                                                                                                                                                                                                                                                        
                
        <form action="index.php? action=list_sessionById" method="post" class="form-insert" id="formulario">
                <h3 class="anuncios">Búsqueda de sesiones por entrenador</h3>
            <select name="id_entrenador">            
                    <option value="">Elija una Opción</option>
                    <?php
                        foreach($entrenadores as $coach){
                            echo"<option value='".htmlspecialchars($coach['email'])."'>".
                            htmlspecialchars($coach['nombres']).
                            htmlspecialchars($coach['apellidos']).
                            "</option>";
                        }
                    ?>
            </select>
            <input type="submit" value="Buscar Sesiones" class="form-botones-session">
        </form>
</div>  
<!-- ================================================================== -->
 <style>
    @font-face {
  font-family: 'fuente3';
  src: url('fonts/fuente3.ttf') format('truetype');/*Nombre real : struck */
}

    #fondo-session-deportista{
            width: 100%;
            height: 30rem;
            background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
    }
    .anuncios{
        color: #D4AF37; 
        font-style: italic;
        font-weight: lighter; 
        letter-spacing: 0.3rem; 
        font-size: 1.3rem;
        font-family: 'fuente3', Arial, Helvetica, sans-serif;
        font-weight: lighter;
        
    }
    #table-sesion{
        width: 80%;
        margin-top: 1rem;
        margin-bottom: 1rem;
        background-color: #4A0D0D;
        border: solid #D4AF37 2px;
        color: #D4AF37;
        font-style: italic;
    }
    
    .form-insert{
        width: 80%;
        display:flex;
        flex-direction: column;
        align-items: center;
        background-color: #4A0D0D;
        border: solid #D4AF37 2px;
        margin-bottom: 4rem;
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
    .form-botones-session{
            background-color: transparent; 
            border:  solid #D4AF37 1px;
            border-radius: 5px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: italic;
            font-size: 1rem;
            font-weight: lighter;
            color:#D4AF37;
            width:30%;
            margin:1rem;
            padding: 0.3rem;
        }
    .form-botones-session:hover{
            background-color: #D4AF37;
            color: #4A0D0D;
        }
    td, th{
        padding: 1%;
        font-size:1vw;
        border:solid #D4AF37 1px;


    }
    .lugarE{
        width: 55%;
    }
    table{    
        width: 100%;
        border: solid #D4AF37 1px;
    }
    #formulario{
        margin:5%;
    }
    .lugar{
        width: 40%;
    }
</style>