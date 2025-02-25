$(document).ready(function () {
    // Cargar países al cargar la página
    $.ajax({
        url: "index.php?action=get_paises", // El archivo PHP que devuelve los países
        method: 'GET',
        dataType: 'json', // Especificamos que la respuesta será en formato JSON
        success: function (paises) {
            paises.forEach(function (pais) {
                $('#pais').append('<option value="' + pais.id + '">' + pais.pais + '</option>');
            });
        }
    });//-------->Ya está------------------

    // Cuando el usuario pasa el cursor sobre un país
    $('#pais').on('change', function () {
        var idPais = $(this).val();  // Obtener el ID del país seleccionado

        // Limpiar departamentos y ciudades
        $('#departamento').empty().append('<option value="">Elige un departamento</option>').hide();
        $('#ciudad').empty().append('<option value="">Elige un departamento</option>').hide();

        if (idPais) {
            // Hacer la petición AJAX para obtener departamentos del país
            $.ajax({
                url: 'index.php?action=get_dptos',
                method: 'GET',
                dataType: 'json',
                data: { id_pais: idPais },
                success: function (departamentos) {
                    departamentos.forEach(function (departamento) {
                        $('#departamento').append('<option value="' + departamento.id + '">' + departamento.departamento + '</option>');
                    });

                    // Mostrar el select de departamentos
                    $('#departamento').show();
                }
            });
        }
    });

    // Cuando el usuario pasa el cursor sobre un departamento
    $('#departamento').on('change', function () {
        var idDepartamento = $(this).val();  // Obtener el ID del departamento seleccionado

        // Limpiar ciudades
        $('#ciudad').empty().append('<option value="">Elige una ciudad</option>').hide();

        if (idDepartamento) {
            // Hacer la petición AJAX para obtener ciudades del departamento
            $.ajax({
                url: 'index.php?action=get_ciudad',
                method: 'GET',
                dataType: 'json',
                data: { id_dpto: idDepartamento },
                success: function (ciudades) {
                    ciudades.forEach(function (ciudad) {
                        $('#ciudad').append('<option value="' + ciudad.codigo + '">' + ciudad.ciudad + '</option>');
                    });

                    // Mostrar el select de ciudades
                    $('#ciudad').show();
                }
            });
        }
    });
});