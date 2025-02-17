


<?php

include_once 'controller/ElementosController.php';
include_once 'controller/ClubController.php';
include_once 'controller/EventController.php';
include_once 'controller/signupController.php';
include_once 'controller/loginController.php';
include_once 'funciones/funciones.php';
include_once 'controller/DeportistaController.php';


$eleControl= new ElementosController();
$clubControl= new ClubController();
$eventControl=new EventController();
$signupController=new SignupController();
$loginController=new LoginController();
$objeto= new objeto();
$depoControl= new DeportistaController();

$fechaHora = new DateTime();
$fechaHora->setTimezone(new DateTimeZone('America/Bogota'));
$fechaA = $fechaHora->format('Y-m-d');
$horaA = $fechaHora->format('H:i:s');

// $eleControl->getDepartamento();
//=======================================EVENTOS POSTERIORES A LA FECHA ACTUAL=====================================
/*$eventos= $eventControl->listEventos();
echo"<p> Eventos posteriores</p><br>";
foreach ($eventos as $event){
    if(strtotime($event['fechaEv'])> strtotime($fechaA)){
        echo $event['fechaEv']. "<br>";
    }    
}
echo"<p> Eventos anteriores</p><br>";
foreach ($eventos as $event){
    if(strtotime($event['fechaEv'])< strtotime($fechaA)){
        echo $event['fechaEv']. "<br>";
    }
}*/
//=========================================================================================================

//====================================================================================

// $perfAdmin= $array[3];
// $perfDepor= $array[0];
// $perfEntre= $array[1];
// $perfRepre= $array[2];
// echo "Perfil Administrador:". $perfAdmin. "<br>";
// echo "Perfil Deportista:". $perfDepor. "<br>";
// echo "Perfil Entrenador:". $perfEntre. "<br>";
// echo "Perfil Representante:". $perfRepre. "<br>";

// $signupController->setPerfil("pinochitoNarizon@hotmail.com");exit;

//    $array1=$loginController->getUserEmail(("carlosju76"));


    /*if (count($array1)>0){
        foreach($array1 as $fila){
            echo $fila['email'] . "<br>";
        }
    }else{
        echo "No se encotraron resultados=(";
    }

    echo $array1[0]['email'] . "<br><br>";

    $array2=$loginController->getPerfil("nilsonh@hotmail.com");

    echo "Retornando un entero: ".$array2;*/

//=======================================================================
/*function arrayPerfil($perfil){
    $i=4;    $array=[0,0,0,0,0];

    while ($perfil>0){  
           $a=$perfil%10;
           $array[$i]+=$a;   
           $perfil= floor($perfil/10);
            $i--;
}

    return $array;
 }

 $numero= 1100;
*/

// $array=$loginController->getUserEmail("carlosju76");
// echo $array[0]['email'] ."<br>";
// echo $array[0]['usuario'];

echo "Hola amigos <br>";

$deportistas= $depoControl->listD("9");

foreach ($deportistas as $dep){
    echo $dep['nombreD']. "<br>";
}

?>

