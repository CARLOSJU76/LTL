

document.getElementById('formulario_SIGNUP').addEventListener('submit', function(event){  
    
    event.preventDefault();
    var For_registro=document.getElementById('formulario_SIGNUP');
    var mensaje= document.getElementById('mensaje_SIGNUP');
        
        FD= new FormData(For_registro);

    fetch('index.php?action=registro', {

        method: 'POST',
        body: FD
    })
    .then( respuesta =>respuesta.json())
    .then(datos => {
        mensaje.textContent= datos.message +" "+ datos.conteo;
        if(datos.success==="ok"){
            mensaje.className="success";
            
        }else {
            mensaje.className="error"; 
                      
        } 
        cerrarSign.click();
        
        setTimeout(() =>{
            location.reload();
        }, 3000);      
    })   
});
