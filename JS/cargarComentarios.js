function cargarComentarios() {
    fetch('index.php?action=get_comments')
        .then(response => response.json())
        .then(data => {
            let comentariosTexto = '';
            let aut = localStorage.getItem('ElUsuario');

            // Iterar sobre los datos y formatear el texto
            data.forEach(comentario => {
                if(comentario.autor != aut || comentario.autor == null){
                    comentariosTexto += `<br><span style= "color:orange;">${comentario.autor}<br></span>`;  
                    comentariosTexto += `${comentario.comentario}<br>`;
                    comentariosTexto += `<span style="font-size: 10px;">Fecha: ${comentario.fecha_hora}  <button class="like-button" data-id="${comentario.id}">Like</button> ${comentario.likes} likes <br></span>`;
                } else {
                    comentariosTexto += `<br><span style= "color:green;">${comentario.autor}<br></span>`;  
                    comentariosTexto += `${comentario.comentario}<br>`;
                    comentariosTexto += `<span style="font-size: 10px;">Fecha: ${comentario.fecha_hora}  ${comentario.likes} likes <br></span>`;
                }
            });
            
            // Mostrar comentarios en el contenedor
            document.getElementById('comments').innerHTML = comentariosTexto;

            // Agregar el evento a los botones "Like"
            const liker=localStorage.getItem('ElUsuario');
            
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', function() {
                    const comentarioId = this.getAttribute('data-id');
                    incrementarLike(comentarioId, liker)
                    .then(() => {
                        // Actualizar el contador de likes en la interfaz
                        const likeCountSpan = document.querySelector(`.like-count[data-id="${comentarioId}"]`);
                        if(likeCountSpan){
                            likeCountSpan.textContent = parseInt(likeCountSpan.textContent) + 1;
                        }
                    })
                    .catch(error => {
                        alert('Hubo un problema al incrementar el like...');
                    });
                });
            });
        })
        .catch(error => console.error('Error:', error));
}

window.onload = cargarComentarios;
