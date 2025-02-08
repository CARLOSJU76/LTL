function cargarComentarios() {
    fetch('funciones/get_comments.php')
        
        .then(response => response.json())
        .then(data => {
           
            let comentariosTexto = '';
            let aut= localStorage.getItem('ElUsuario');

            // Iterar sobre los datos y formatear el texto
            data.forEach(comentario => {
                if(comentario.autor!=aut || comentario.autor==null){
                    comentariosTexto += `<br><span style= "color:orange;">${comentario.autor}<br></span>`;  
                    comentariosTexto += `${comentario.comentario}<br>`;
                    comentariosTexto += `<span style="font-size: 10px;">Fecha: ${comentario.fecha_hora}  <button class="like-button" data-id="${comentario.id}">Like</button> ${comentario.likes} likes <br></span>`;
                }else{
                comentariosTexto += `<br><span style= "color:green;">${comentario.autor}<br></span>`;  
                comentariosTexto += `${comentario.comentario}<br>`;
                comentariosTexto += `<span style="font-size: 10px;">Fecha: ${comentario.fecha_hora}  ${comentario.likes} likes <br></span>`;

                }
                
            });
            
            // Mostrar comentarios en el textarea
            document.getElementById('comments').innerHTML = comentariosTexto;
            const liker= localStorage.getItem('ElUsuario');
            
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Obtener el valor del atributo data-id del botón clickeado
                    const comentarioId = this.getAttribute(`data-id`);
              //    alert('Botón Like clickeado para comentario con ID:'+ comentarioId);
              //    paracoment.textContent= comentarioId;

              incrementarLike(comentarioId, liker)
              .then(()=>{
                //Actualizar el contador de likes en la interfaz
                const likeCountSpan=document.querySelector(`.like-count[data-id="${comentarioId}"]`);
                if(likeCountSpan){
                    likeCountSpan.textContent=parseInt(likeCountSpan.textContent)+1;
                }
              })
              .catch(error=> {
                alert('Hubo un problema al incrementar el like...en el js');
              })
                 

                });
            });
              
        })
        // .catch(error => console.error('Error:', error));

}
window.onload = cargarComentarios;

//Programando evento para los botones like--->
//==========================================================================================
//función para incrementar el númeo de likes:
function incrementarLike(comentarioId,liker) {
    sesionInciada= localStorage.getItem('sesionIniciada');
  

    if(sesionInciada==='true'){
        
        const currentDate = new Date().toLocaleDateString('en-CA'); // Formato: YYYY-MM-DD
        
        return fetch('funciones/like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: comentarioId, name:liker, currentDate:currentDate})
        })
        .then(response => response.json())
        .then(result=>{
            location.reload();
            alert(result.message);
            document.getElementById('comments').style.display="block";
        })
        .catch(error => console.error('Error:', error));

    }else{
        alert("Debes iniciar sesión para interactuar en los comentarios.");
    }    
}

