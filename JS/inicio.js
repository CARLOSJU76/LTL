
//FUNCIÓN QUE PROGRAMA EL EVENTO DEL BOTÓN LOGIN
//============================================================================================================

let con_comentarios= document.getElementById('contenedor_comentarios');
var for_LOG= document.getElementById('formulario_LOGIN');
let mensajeLog=document.getElementById('mensaje_LOGIN');
let nombreUsuario="";

for_LOG.addEventListener('submit', function(event){
    event.preventDefault();
   //alert("hola amigos");

    formuData= new FormData(for_LOG);

    fetch('index.php?action=loguear',{
        method: 'POST',
        body:formuData
    })
    .then(respuesta =>respuesta.json())
    .then(datos => {
        mensajeLog.textContent= decodeURIComponent(datos.message);
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
        let perfil_usuario=document.getElementById('perfil-usuario');
        let perfil_inicial=document.getElementById('perfil-inicio'); 
    
    if(sesionActual=='true'){
        saludoInicial.innerHTML=  `Hola <span style="color: #4A0D0D; font-weight:bold; ">${ElUsuario}</span>, Estás en LitolWrestling Web!!`;  
        autor.value=ElUsuario;
   
    perfil_usuario.className='opciones_activas';
    perfil_inicial.className='opciones_inactivas';
   
    }else{
        perfil_usuario.className='opciones_inactivas';
        perfil_inicial.className='opciones_activas';
    }
        
}

//Función para cerrar valor al elegir la opción salir:
document.getElementById('select-usuario').addEventListener('change', function() {
    const selectedValue = this.value;
    
    if (selectedValue === '5') {
        // Si la opción "Salir" es seleccionada, realizar una petición para cerrar la sesión.
        cerrarSesion();
    }
});

function cerrarSesion() {
    let ElUsuario= localStorage.getItem('ElUsuario');
    fetch('funciones/logout.php')
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            localStorage.removeItem('sesionIniciada'); // 
            localStorage.removeItem('ElUsuario');
            localStorage.removeItem('Cont_comentarios');
            configInicio();            
        }
        mensajeLog.className='error';
        mensajeLog.textContent= ElUsuario + ", acabaste de Cerrar la Sesión!!";
        setTimeout(() =>{
            location.reload();
        }, 3000); 
    });
}
//función al obturar botón cerrar o mostrar comentarios
let e_comments=document.getElementById('enable-comments');
let d_comments= document.getElementById('disable-comments');
//Para mostrar los comentarios
function enable_comments(){
    localStorage.setItem('Cont_comentarios', 'activos');     
    comentariosActivos();
}
//Para cerrar los comentarios
function disable_comments() {
    localStorage.setItem('Cont_comentarios', 'desactivados');
    comentariosActivos();
    
}
function comentariosActivos(){
    if(localStorage.getItem('Cont_comentarios')=='activos'){
        con_comentarios.className='comentarios-activos';
        d_comments.className='boton-circulo'; 
        e_comments.className='opciones_inactivas';
    }else{
        con_comentarios.className='opciones_inactivas';
        e_comments.className='boton-circulo';
        d_comments.className='opciones_inactivas';
    }
    
}
