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
                echo json_encode(array("success"=> "ok","conteo"=>"$x","message"=> "Bienvenido, $usuario, El registro fue exitoso!!  :)"));
            //echo "Registro exitoso";
            }else if($x<0){
                echo json_encode(array("success"=> "repeat","conteo"=>"$x","message"=> "Usuario o email ya se encuentran registrados. :|"));//hasta aquí todo bien!!
                //echo "Usuario o email ya se encuentran registrados.";
            }else{
                echo json_encode(array ("success"=> "error","conteo"=>"$x", "message"=> "Hubo un error. El registro no fué exitoso :("));
                //echo "Hubo un error.";
            }
        }

        function notifilogin($opcion, $user1, $perfil){
            header('Content-Type: application/json'); // Asegurando que la respuesta sea JSON
        
            if ($opcion === 1) {
                echo json_encode(array("status" => "success", "message" => "Bienvenido $user1, iniciaste sesión exitosamente.Nueva actualización. Perfil: $perfil", "nombre" => $user1, "perfil" =>$perfil));
            } else if ($opcion === 0) {
                echo json_encode(array("status" => "error", "message" => "Credenciales inválidas. Opción: $opcion", "opcion" => 4 + $opcion));
            } else if($opcion === -2) {
                echo json_encode(array("status" => "error", "message" => " La cuenta de correo no ha sido verificada. Opcion= $opcion", "opcion" => $opcion));
            }else{
                echo json_encode(array("status" => "error", "message" => " Usuario no se encuentra registrado. Opcion: $opcion", "opcion" => $opcion));
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
        function notiVerifyEmail($estado,$usuario){
            header('Content-Type:application/jason');
            if($estado==1){
                echo json_encode(array("estado"=>"ok", "message"=>"Hola $usuario, La cuenta ha sido verificado exitosamente."));
            }else if($estado==0){
                echo json_encode(array("estado"=>"no_email", "message"=>"Dirección de correo electrónico no registrada."));
            }else{
                echo json_encode(array("estado"=>"no_token", "message"=>"Verificación fallida. El token no ha sido proporcionado."));
            }
        }
       
}
    


    

?>