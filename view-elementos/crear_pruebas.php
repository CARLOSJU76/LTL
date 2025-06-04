Hola Amigos, Bienvenidos a la creación de pruebas físicas!!

<div id="fonco-pruebas">
    <form action="index.php?action=crear_pruebas" method="post">
        <input type="text" name="nombre_prueba" id="ejercicio" placeholder="Digite el Nombre de la Prueba" required>
        <select name="unidades" id="select-unidades"  required>
            <option value="">Elija Unidades</option>
            <?php if($unidades):?>
                <?php foreach($unidades as $unidad){
                    echo "<option value='".htmlspecialchars($unidad['id'])."'>"
                        .htmlspecialchars($unidad['unidades'])."</option>";
                }
                ?>
            <?php endif;?>
        </select>
        <input type="submit" id="crear-prueba" value="Crear Prueba">
    </form>
</div>