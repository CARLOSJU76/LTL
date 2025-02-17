

document.getElementById('select-admin' ).addEventListener('change', function() {
            const selectedValue = this.value;

            if (selectedValue === 'logout') {
                cerrarSesion(); // Llamar a la función de cerrar sesión
            } else {
                this.form.action = 'index.php'; // Asegurar la acción del formulario
                this.form.submit(); // Enviar el formulario
            }
        });


    document.getElementById("select-pais").addEventListener("change", function() {
   
        var valorSeleccionado = this.value;

        var url = "index.php?action=get_dpto&id_pais=" + encodeURIComponent(valorSeleccionado);

        window.location.href = url;
                });
