<div id="fondo-pruebas">
    <div id="contenedor-pruebas">
    <?php if (!empty($pruebas)): ?>
        <h3 style="color: #D4AF37; font-style: italic; letter-spacing: 0.3rem;">
            Pruebas Registradas: </h3>
        <table border="1" cellpadding="5" cellspacing="0" id="tabla-pruebas">
            <thead id="thead-pruebas">
                <tr>
                    <th>Nombre de la Prueba</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pruebas as $prueba): ?>
                    <tr>
                        <td><?= htmlspecialchars($prueba["nombre_prueba"]) ?></td>
                        <td><?= htmlspecialchars($prueba["unidades"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay pruebas registradas.</p>
    <?php endif; ?>
    <form action="index.php?action=crear_pruebas" method="post" id="form-pruebas">
        <h3 style="color: #D4AF37; font-style: italic; letter-spacing: 0.3rem;">
            Formulario Creación de Pruebas </h3>
        <div id="datos-post">
            <input type="text" name="nombre_prueba" id="ejercicio" placeholder="Digite el Nombre de la Prueba" required>
            <select name="unidades" id="select-unidades"  required>
            <option value="">Elija Unidades</option>
                <?php foreach($unidades as $unidad){
                    echo "<option value='".htmlspecialchars($unidad['id'])."'>"
                        .htmlspecialchars($unidad['unidades'])."</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" id="boton-crearPrueba" value="Crear Prueba">
    </form>
    </div>
</div>
<style>
    #fondo-pruebas{
         background-image: url('./IMG/LTL/dark-mat.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;

        width: 100%;
        height: 30rem;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #contenedor-pruebas{
        background-color: #4A0D0D;
        border:#D4AF37;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 60%;
        padding:1rem;
        border: #D4AF37 solid 2px;
        border-radius:4px;
    }
    #tabla-pruebas{
        color:#D4AF37;
        font-size: 1rem;
        padding: 0.4rem;
        font-style: italic;
        font-weight: lighter;
        letter-spacing: 0.2rem;
        margin-bottom: 1rem;
        width: 80%;
    }
    #thead-pruebas{
        color: white;
    }
    #form-pruebas{
        width: 80%;
        background-color: transparent;
        border: #D4AF37 solid 2px;
        border-radius: 4px;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 0.3rem;

    }
    #datos-post{
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        margin:0.4rem;
    }
    #boton-crearPrueba{
    width: 80%;
    background: linear-gradient(to bottom, #D4AF37, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1rem;
    font-weight: bold;
    color:#4A0D0D;
    font-style: italic;
    letter-spacing: 0.3rem;
    padding: 0.3rem;

    }
    #ejercicio, #select-unidades{
        width: 45%;
        text-align: center;
        padding:0.3rem;
        font-size: 0.8rem;
        font-style: italic;
        border: #D4AF37 solid 2px;
        border-radius: 3px;
    }
</style>