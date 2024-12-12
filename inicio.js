
//FUNCIÓN QUE PROGRAMA EL EVENTO DEL BOTÓN LOGIN
//============================================================================================================
var for_LOG= document.getElementById('formulario_LOGIN');
let mensajeLog=document.getElementById('mensaje_LOGIN');
let nombreUsuario="";

for_LOG.addEventListener('submit', function(event){
    event.preventDefault();
    console.log("hola amigos");

    formuData= new FormData(for_LOG);

    fetch('../inicioLTL.php',{
        method: 'POST',
        body:formuData
    })
    .then(respuesta =>respuesta.json())
    .then(datos =>{
        mensajeLog.textContent= datos.message;
        nombreUsuario=datos.nombre;       
        
        if(datos.status=="success"){
            localStorage.setItem('sesionIniciada','true'); //metodo para establecer una matriz asociativa
            localStorage.setItem('ElUsuario', nombreUsuario); 
               
            mensajeLog.className='success';
     
           
             
        }else{         
            mensajeLog.className='error';
        }
        cerrarLogin.click();
        setTimeout(() =>{
            location.reload();
        }, 3000);  
    })
    .catch(error => console.error('Error:', error));
})
configInicio();

//FUNCION PARA DETERMINAR LOS PARÁMETROS DE LA FUNCIÓN INICIADA:
//=================================================================================================================

function configInicio(){
    let sesionActual= localStorage.getItem('sesionIniciada');
    const ElUsuario= localStorage.getItem('ElUsuario');
    let autor= document.getElementById('autor');
    let saludoInicial= document.getElementById('saludoInicial');
        let sesion_off=document.getElementById('sesion_off');
        let sesion_on=document.getElementById('sesion_on');
    
    

    if(sesionActual=='true'){
        saludoInicial.innerHTML=  `Hola <span style="color: #4A0D0D; font-weight:bold; ">${ElUsuario}</span>, Estás en LitolWrestling Web!!`;  
        autor.value=ElUsuario;
   
    sesion_on.className='opciones_activas';
    sesion_off.className='opciones_inactivas';
   
    }else{
        sesion_on.className='opciones_inactivas';
        sesion_off.className='opciones_activas';
    }
        

}
//Función para cerrar valor al elegir la opción salir:
document.getElementById('deportista').addEventListener('change', function() {
    const selectedValue = this.value;
    
    if (selectedValue === '5') {
        // Si la opción "Salir" es seleccionada, realizar una petición para cerrar la sesión.
        cerrarSesion();
    }
});
function cerrarSesion() {
    let ElUsuario= localStorage.getItem('ElUsuario');
    fetch('logout.php')
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            localStorage.removeItem('sesionIniciada'); // 
            configInicio();
            
        }
        mensajeLog.className='error';
        mensajeLog.textContent= ElUsuario + ", acabaste de Cerrar la Sesión!!";
        setTimeout(() =>{
            location.reload();
        }, 3000); 
    });
}