

document.querySelectorAll('#select-usuario, #select-deportista, #select-entrenador, #select-dirigente, #select-admin' )
    .forEach(select => {
        select.addEventListener('change', function() {
            const selectedValue = this.value;

            if (selectedValue === 'logout') {
                cerrarSesion(); // Llamar a la función de cerrar sesión
            } else {
                this.form.action = 'index.php'; // Asegurar la acción del formulario
                this.form.submit(); // Enviar el formulario
            }
        });
    });
