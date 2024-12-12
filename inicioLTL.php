<?php


    $usuario=$_POST["usuario"];
    $passw=$_POST["passw"];

    $conexion= conexion();
    $array= verificar($conexion, $usuario, $passw);
    $opcion=$array[0];
    $user1=$array[1];
    notificar($opcion, $user1);
    $conexion->close();  


//FUNCIÓN para establecer la conexión: 

function conexion(){
    
    $servidor='localhost';
    $user='root';
    $password='';
    $bd='sistema_rank';
    $puerto=3307;

    $conexion= new mysqli($servidor, $user, $password, $bd, $puerto);    

   /* if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
        echo"conexión fallida";
    }else{
        echo"conexión exitosa";
    }*/
    return $conexion;
}

//FUNCIÓN PARA VERIFICAR COINCIDENCIA DE USUARIO:
function verificar($conexion, $usuario, $passw ){
    $datos=[];
    $clave="";
    $user1="";
    $consulta= $conexion->prepare("SELECT passw, usuario from usuarios where usuario=? or email=? ");
    $consulta->bind_param("ss", $usuario, $usuario);
    $consulta->execute();
    $consulta->bind_result($clave, $user1);
    if($consulta->fetch()){
        if(password_verify($passw, $clave)){
            $opcion=1;
        }else{
            $opcion=0;
        }
    }else{
        $opcion=-1;
    }

    array_push($datos, $opcion, $user1);
    return $datos;
    $consulta->close();
    
}

//FUNICIÓN PARA TRNASMITIR EL MENSAJE JSON :
function notificar($opcion, $user1){

    if($opcion===1){
        echo json_encode(array("status" =>"success", "message"=>"Bienvenido $user1, iniciaste sesión exitosamente.", "nombre"=> $user1));
        //echo "Inicio de sesión exitoso.";
    }else if($opcion===0){
        echo json_encode(array("status" =>"error", "message"=>" Credenciales inválidas."));
        //echo "Credenciales inválidas";
    }else{
        echo json_encode(array("status" =>"error", "message"=>" Usuario no se encuentra registrado."));  
        //echo "Usuario no se encuentra registrado.";
    }
}

?> 