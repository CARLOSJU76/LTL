
document.getElementById('RegistroComentarios').addEventListener('submit', function(event){  
    event.preventDefault();
    
    var For_comentarios = document.getElementById('RegistroComentarios');
    var mensajeC = document.getElementById('mensaje_COMMENT');
    let botonC= document.getElementById("e-comments");
    
    
    //alert("Cargando un Comentario de " + autor.value);
    NN = new FormData(For_comentarios);

    fetch('index.php?action=insert_comment', {
        method: 'POST',
        body: NN
    })
    .then(respuesta => respuesta.json())
    .then(data => {
       
        if (data.comment == "ok") {
            mensajeC.className = "success";    
        } else {
            mensajeC.className = "error";                          
        }

        mensajeC.textContent = decodeURIComponent(data.message);         
        setTimeout(() => {
        location.reload();        
        }, 3000);  // Recargar después de 6 segundos
      
    })  
    
});
comentariosActivos();