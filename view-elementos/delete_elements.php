
    
<script src="JS/jquery-3.7.1.min.js"></script>
<!-- ====================================================================================================== -->
<div id="fondo-delC">
    <div class="container" id="container_general">
        <div id="div-h2"><h3>LTL Website</h3></div>
<!-- ===================================FORMULARIO DE INSERCIÓN DE CATEGORÍA POR EDAD============================================================================================= -->
        <form action="index.php?action=delete_categoria" method="post" id="formulario_inserclubes">

            <table class="table" id="tabla_inser_clubes">
        <!-- Primera fila: Encabezado -->
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Eliminar Categoría de Edad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select id="select_categoria1" class="form-select" name="id_categoria" required>
                                <option value="">Elige la Categoria</option>
                                <!-- Aquí se llenarán los departamentos según el país -->
                            </select>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Eliminar Categoría de Edad</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

<!-- ======================================================================================================================================== -->
<!-- ===================================FORMULARIO DE ELIMINACIÓN DE MODALIDAD============================================================================================= -->
        <form action="index.php?action=delete_modalidad" method="post" id="formulario_inserclubes">

            <table class="table" id="tabla_inser_clubes">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Eliminar Modalidad</th>
                    </tr>
                </thead>
                    <tbody>
                    <tr>
                        <td>
                            <select id="select_modalidad1" class="form-select" name="id_modalidad" required>
                                <option value="">Elige la Modalidad</option>
                                    <!-- Aquí se llenarán los países desde la base de datos -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Eliminar Modalidad</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- ======================================================================================================================================== -->
<!-- ===================================FORMULARIO DE ELIMINACIÓN DE DIVISIÓN DE PESO============================================================================================= -->
        <form action="index.php?action=delete_division" method="post" id="formulario_inserclubes">
            <table class="table" id="tabla_inser_clubes">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" id="head-inser_club">Eliminar División de Peso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
<!-- ========================================================================================================================================== -->
                        <td id="td-ubicacion">
                            <div class="menu">
<!-- ========================================================================================================================================== -->
                                <div id="uno">
                                    <select id="select_modalidad" class="form-select"  required>
                                        <option value="">Elige la Modalidad</option>
                                        <!-- Aquí se llenarán los países desde la base de datos -->
                                    </select>
                                </div>
<!-- ========================================================================================================================================== -->
                                <div id="dos">
                                    <select id="select_categoria" class="form-select"  required>
                                        <option value="">Elige la Categoria</option>
                                        <!-- Aquí se llenarán los departamentos según el país -->
                                    </select>
                                </div>
<!-- ========================================================================================================================================== -->
                                <div id="tres">
                                    <select id="select_division" name="id_division"  class="form-select" style="display:none;" required>
                                        <option value="">División de Peso</option>
                                        <!-- Aquí se llenarán las ciudades según el departamento -->
                                    </select>
                                </div>
<!-- ========================================================================================================================================== -->
                            </div>
                        </td>
<!-- ========================================================================================================================================== -->
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Eliminar División de Peso </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<!-- ==================================================================================================== -->
<link rel="stylesheet" href="./CSS/club_manage.css">
<link rel="stylesheet" href="./CSS/insert_represent.css">
<link rel="stylesheet" href="./CSS/desp_Ubicacion.css">
<link rel="stylesheet" href="./CSS/inscrip_depor.css">
<style>
    #container_general{
        overflow: auto;
        background-color:  #4A0D0D;
        border: 2px solid #D4AF37;
        border-radius: 4px;
        margin: 3rem; 
    }

    #fondo-delC{
        background-image: url('./IMG/LTL/luchafemenil.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        }
</style>
<!-- ==================================================================================================== -->
<script>
    $(document).ready(function () {
        $.ajax({
            url: "index.php?action=get_categorias", // El archivo PHP que devuelve los países
            method: 'GET',
            dataType: 'json', // Especificamos que la respuesta será en formato JSON
            success: function (categorias) {
                categorias.forEach(function (categoria) {
                    $('#select_categoria1').append('<option value="' + categoria.id + '">' + categoria.categoria + '</option>');
                });
            }
        });
  
        $.ajax({
            url: "index.php?action=get_modalidades", // El archivo PHP que devuelve los países
            method: 'GET',
            dataType: 'json', // Especificamos que la respuesta será en formato JSON
            success: function (modalidades) {
                modalidades.forEach(function (modalidad) {
                    $('#select_modalidad1').append('<option value="' + modalidad.id + '">' + modalidad.modalidad + '</option>');
                });
            }
        });

        $.ajax({
            url: "index.php?action=get_modalidades", // El archivo PHP que devuelve los países
            method: 'GET',
            dataType: 'json', // Especificamos que la respuesta será en formato JSON
            success: function (modalidades) {
                modalidades.forEach(function (modalidad) {
                    $('#select_modalidad').append('<option value="' + modalidad.id + '">' + modalidad.modalidad + '</option>');
                });
            }
        });

        $.ajax({
            url: "index.php?action=get_categorias", // El archivo PHP que devuelve los países
            method: 'GET',
            dataType: 'json', // Especificamos que la respuesta será en formato JSON
            success: function (categorias) {
                categorias.forEach(function (categoria) {
                    $('#select_categoria').append('<option value="' + categoria.id + '">' + categoria.categoria + '</option>');
                });
            }
        });

        $('#select_categoria').on('change', function () {
        var idCategoria = $(this).val();  // Obtener el ID del departamento seleccionado
        var idModalidad = $('#select_modalidad').val(); 
        // Limpiar ciudades
        $('#select_division').empty().append('<option value="">División de Peso</option>').hide();

        if (idCategoria) {
            // Hacer la petición AJAX para obtener ciudades del departamento
            $.ajax({
                url: 'index.php?action=get_divisiones',
                method: 'GET',
                dataType: 'json',
                data:{  id_categoria: idCategoria,
                        id_modalidad: idModalidad   },
                success: function (divisiones) {
                    divisiones.forEach(function (division) {
                        $('#select_division').append('<option value="' + division.codigo + '">' + division.categoriaxPeso + '</option>');
                    });

                    // Mostrar el select de ciudades
                    $('#select_division').show();
                }
            });
        }
    });

    });

   
</script>
<!-- ==================================================================================================== -->