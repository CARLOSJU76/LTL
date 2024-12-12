<?php
$servidor= "localhost";
$usuario= "root";
$clave= "";
$bd= "sistema_rank";
$puerto= 3307;

$conexion= new mysqli($servidor, $usuario, $clave,$bd,$puerto);

if($conexion->connect_error){
    die("Conexión fallida". $conexion->connect_error);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
       
    $autor=$_POST['autor'];
    $comentario=$_POST['comentario'];

$consulta= "INSERT INTO comentarios(comentario, autor) VALUES ('$comentario', '$autor')";
$stmt=$conexion->prepare($consulta);


if($conexion->query($consulta)===true){
    echo "comentario registrado exitosamente";

}else{
    echo "Hubo un error al procesar el comentario. ";
}
$conexion->close();
}

?>


