<?php if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $email_user = $_SESSION['email'] ?? 'No encontrado';
                    $perfil= $_SESSION['perfil'] ?? 'No encontrado';
?>

<!--<?php echo htmlspecialchars($usuario); ?> tEXTO PAR AGREGAR EN EL HIDDEN-->

<div id="fondo_cambiar_pass">
        <h3 style="color:white; letter-spacing:0.3rem; font-weight:lighter; font-style:italic; font-family: 'Courier New', Courier, monospace;"><?php echo htmlspecialchars($email_user); ?></h3>
        <form action="index.php?action=cambiar_pass" method="POST" id="form_cambiar_pass">
            <h3 style="font-weight: lighter; letter-spacing:0.3rem;">Cambiar contraseña</h3>
            <input class="select-cambiar_pass" type="hidden" name="email" value="<?php echo htmlspecialchars($email_user)?>"><br> 
            <input class="select-cambiar_pass" type="password" name="actual" placeholder="Digita tu contraseña" required><br>
            <input class="select-cambiar_pass" type="password" name="nueva" placeholder="Digita una nueva contraseña" required><br>
            <input class="select-cambiar_pass" type="password" name="confirm" placeholder="Confirma tu contraseña" required><br>
            <button id="submit-cambiar-pass" type="submit" name="enviarEnlace">Actualizar contraseña</button>
        </form>
    </div>

<style>
    #fondo_cambiar_pass {
             background-image: url('./IMG/LTL/mat.jpg');
            /* background-size: cover; Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
    }
    #form_cambiar_pass {
        background-color: #4A0D0D;
        color:#D4AF37;
        padding: 2rem;
        border:#D4AF37 solid 1px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 40rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 3rem;
        font-style: italic;
    }
    .select-cambiar_pass {
        width: 80%;
        padding: 0.5rem;
        margin: 0.5rem 0;
        border-radius: 5px;
        border: 1px solid #D4AF37;
        background-color: #DCDCDC;
        font-size: 1.2rem;
        font-style: italic;
    }
    #submit-cambiar-pass {
    width: 80%;
 
    background: linear-gradient(to bottom, #ffd700, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5);
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1vw;
    font-weight: bold;
    color:#4A0D0D;
    border:none;
    font-size: 1.2rem;
    font-style: italic;
    padding: 0.5rem;
}
</style>