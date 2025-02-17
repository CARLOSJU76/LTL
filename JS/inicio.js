
//FUNCIÓN QUE PROGRAMA EL EVENTO DEL BOTÓN LOGIN
//============================================================================================================

let con_comentarios= document.getElementById('contenedor_comentarios');
var for_LOG= document.getElementById('formulario_LOGIN');
let mensajeLog=document.getElementById('mensaje_LOGIN');
let nombreUsuario="";
let perfil_input= document.getElementById('perfil_de_usuario');
let perfil1 =JSON.parse(localStorage.getItem('perfil'));


let opciones = [
    {id_perfil: 4, valor: '', texto: 'Opciones de Usuario' },
    {id_perfil: 3, valor: 'my_performance', texto: 'My performances' },
    {id_perfil: 2, valor: 'trainer_manage', texto: 'Sesiones de Entrenamiento' },
    {id_perfil: 1, valor: 'sport_manage', texto: 'Deportistas y Entrenadores' },
    {id_perfil: 0, valor: 'club_manage', texto: 'Gestion de Clubes' },
    {id_perfil: 0, valor: 'elements_manage', texto: 'Gestor de Elementos' },
    {id_perfil: 0, valor: 'event_manage', texto: 'Competencias y Calendario' },
    {id_perfil: 4, valor: 'logout', texto: 'Salir' }
  ];
 

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
        perfil= datos.perfil;
            
        
        if(datos.status=="success"){
            localStorage.setItem('sesionIniciada','true'); //metodo para establecer una matriz asociativa
            localStorage.setItem('ElUsuario', nombreUsuario); 
            localStorage.setItem('perfil', JSON.stringify(perfil));
                
            alert(perfil);
               
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


//==============================ARRAY DE OBJETOS QUE DESCRIBEN EL PERFIL DEL USUARIO============================================

//====FUNCIÓN QUE ESTABLECE LA CONFIGURACIÓN EN EL INICIO DE SESIÓN=======================================================
function configInicio(){
    let sesionActual= localStorage.getItem('sesionIniciada');
    const ElUsuario= localStorage.getItem('ElUsuario');
    let autor= document.getElementById('autor');
    let saludoInicial= document.getElementById('saludoInicial');
        
        let perfil_inicial=document.getElementById('perfil-inicio'); 
        let perfil_administrador=document.getElementById('perfil-administrador');
    
    if(sesionActual=='true'){
        saludoInicial.innerHTML=  `Hola <span style="color: #4A0D0D; font-weight:bold; ">${ElUsuario}</span>, Estás en LitolWrestling Web!!`;  
        autor.value=ElUsuario;
        perfil_inicial.className='opciones_inactivas';
        perfil_administrador.className='opciones_activas';
        mostrarSelect(perfil1);
    }else{       
        perfil_inicial.className='opciones_activas';
    }        
}
//======================================================================================================================
function mostrarSelect(perfil1) {
    const select = document.getElementById('select-admin'); //  <select> con id="select-admin"
    select.innerHTML = ''; // Limpiamos el contenido del select
  
    // Filtramos las opciones según el perfil del usuario
    opciones.forEach(opcion => {
      if (perfil1[opcion.id_perfil] == 1) {
        const option = document.createElement('option');
        option.value = opcion.valor;
        option.textContent = opcion.texto;
        select.appendChild(option);
      }
    });
  }
//============FUNCIÓN PARA ACTIVAR Y DESACTIVAR COMENTARIOS============================================================
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
//===============FUNCIÓN PARA OLVIDASTE LA CONTRASEÑA====================================================================
document.addEventListener("DOMContentLoaded", function() {
    let mail = document.getElementById("usuario"); // Obtener el valor del input
    var enlace = document.getElementById("olvidaste"); // Obtener el enlace

    enlace.addEventListener("click", function(event) {

    event.preventDefault();

//enlace.href = "rec_pass_form.php?correo=" + encodeURIComponent(texto);
    enlace.href = "index.php?action=recover_pass&email=" + (mail.value);
    window.location.href= enlace.href;

    });
});
function mostrarMensaje() {
    document.getElementById('btnEnviar').style.display = 'none';  // Ocultar el botón
    document.getElementById('mensajeConfirmacion').style.display = 'block';  // Mostrar el mensaje
}
//==============FUNCIÓN PARA CERRAR SESIÓN================================================================================
function cerrarSesion() {
    let ElUsuario= localStorage.getItem('ElUsuario');
    fetch('funciones/logout.php')
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            localStorage.removeItem('sesionIniciada'); // 
            localStorage.removeItem('ElUsuario');
            localStorage.removeItem('Cont_comentarios');
            localStorage.removeItem('perfil');
           
            configInicio();            
        }
        mensajeLog.className='error';
        mensajeLog.textContent= ElUsuario + ", acabaste de Cerrar la Sesión!!";
        setTimeout(() =>{
            location.reload();
        }, 3000); 
    });
}