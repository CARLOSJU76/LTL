<?php
    //FUNCION PARA VERIFICAR CONTRASEÑAS: 
    class objeto{
        function clavesIguales($x, $y){
            $sonIguales=0;
            if($x===$y){
                $sonIguales=1;
            }else{
                $sonIguales=0;
            }
            return $sonIguales;
    }  

    //función para alertar notificaciones de registro:
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

}
    


    

?>