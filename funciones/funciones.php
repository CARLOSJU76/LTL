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
            header('Content-Type: application/json'); 
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

        function notifilogin($opcion, $user1){
            header('Content-Type: application/json'); // Asegurando que la respuesta sea JSON
        
            if ($opcion === 1) {
                echo json_encode(array("status" => "success", "message" => "Bienvenido $user1, iniciaste sesión exitosamente.", "nombre" => $user1, "opcion" => 4 + $opcion));
            } else if ($opcion === 0) {
                echo json_encode(array("status" => "error", "message" => "Credenciales inválidas.", "opcion" => 4 + $opcion));
            } else {
                echo json_encode(array("status" => "error", "message" => "Usuario no se encuentra registrado.", "opcion" => 4 + $opcion));
            }
            exit(); // Termina la ejecución después de enviar la respuesta
        }
        function noticomment($estado){
            header('Content-Type: application/json'); 
           
            if($estado==1){
                echo json_encode(array("comment"=> "ok", "message" =>"El comentario fue registrado exitosamente!!"));
            }else{
                echo json_encode(array("comment"=> "error", "message" =>"Debes iniciar sesión para compartir tu comentario." ));
            }
            exit();
        }
       
}
    


    

?>