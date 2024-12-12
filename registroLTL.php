<?php
    
    //Para el botón REGISTRAR: 
    
   
    $usuario= $_POST['username'];
    $email= $_POST['email'];
    $password= $_POST['password'];  
    $confirmacion= $_POST['confirmacion'];

    $conexion= conexionBD();
    $sonIguales=clavesIguales($password,$confirmacion);
    if($sonIguales===0){
        echo json_encode(array('status'=> 'error','message'=> 'Los campos de las contraseñas deben tener el mismo valor'));
    }else{
        $conteo= verificarCredenciales($usuario, $email,$conexion);
        $registro= registrando($conteo, $conexion, $usuario, $email, $password);
        notificacion($registro, $usuario);
    }
    

    
    
//FUNCION PARA VERIFICAR CONTRASEÑAS: 
function clavesIguales($x, $y){
    $sonIguales=0;
    if($x===$y){
        $sonIguales=1;
    }else{
        $sonIguales=0;
    }
    return $sonIguales;
}

//FUNCIÓN PARA ESTABLECER CONEXIÓN: 
function conexionBD(){
    $server= "localhost";
    $user= "root";
    $passw= "";
    $bd= "sistema_rank";
    $port= 3307;

    $conexion= new mysqli($server, $user, $passw, $bd, $port);

    return $conexion;
}
//FUNCIONES PARA REGISTRO DE USUARIOS: 
//función para verificar credenciales de usuario y email.
function verificarCredenciales($user,  $email, $conex){
    $conteo=0;
    $verificar= $conex->prepare("SELECT COUNT(*) FROM usuarios where usuario= ? || email= ?");
    $verificar->bind_param("ss", $user, $email);
    $verificar->execute();
    $verificar->bind_result($conteo);
    $verificar->fetch();
    $verificar->close();

    return $conteo;
}
//función para encriptar contraseña y realizar registro: 
function registrando($conteo,$conex, $user, $email, $clave ){
    if($conteo===0){
        $query=0;
        $encriptada= password_hash($clave, PASSWORD_DEFAULT);
        $consulta= $conex->prepare("INSERT INTO usuarios (usuario, email, passw) VALUES (?,?,?)");
        $consulta->bind_param("sss", $user, $email, $encriptada);
        $resultado= $consulta->execute();
                  
        $consulta->close();
        if($resultado){
            $query=1;
        }           

    }else{
       $query=-1;
    }
    return $query;
}
//función para alertar notificaciones:
    function notificacion($x, $usuario){
        if($x>0){
            echo json_encode(array("success"=> "ok","message"=> "Bienvenido, $usuario, El registro fue exitoso!!  :)"));
           //echo "Registro exitoso";
        }else if($x<0){
            echo json_encode(array("success"=> "repeat","message"=> "Usuario o email ya se encuentran registrados. :|"));
            //echo "Usuario o email ya se encuentran registrados.";
        }else{
            echo json_encode(array ("success"=> "error", "message"=> "Hubo un error. El registro no fué exitoso :("));
            //echo "Hubo un error.";
        }
    }
    

?>