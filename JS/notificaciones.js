function getTo(){
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');
    const action = urlParams.get('action');  
    return    [token, action];
   }
   function verifyEmail(){
    if(localStorage.getItem('emailVerified')==='true'){
        alert('Ya se ha verificado el correo.');
        return;
    }else{
        [token, action]=getTo();   // Suponiendo que 'getTo' retorna un objeto con 'token' y 'action'
        
        if (action === 'verify_email') {
       
            fetch('index.php?action=verify_email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({token: token})
            })
            
            .then(response => response.json())
            .then(data=>{
                if (data.estado=='no_email') {
                    // Si la verificación fue exitosa
                    alert('¡Verificación exitosa!');
                    localStorage.setItem('emailVerified', 'true');  // Marcar como verificado
                } else {
                    // Si hubo un error en la verificación
                    alert('Error en la verificación: ' + data.message);
                }             
            }).catch(function(error) {
                console.error('Error en la solicitud:', error);
                alert("este es el mensaje--> "+ token + " "+ action );
            });   
        }else {
            alert('Parámetros inválidos en la URL.');
        }
    }
}
verifyEmail();
