<!-- =========================================================================================================================== -->
<div class="container mt-4" id="contenedor-elementos" >
    <div id="div-h2"><h3>LTL Website</h3></div>
        <!-- Formulario dentro de una tabla centrada -->
       
    <form action="index.php" method="GET" id="formulario-elementos">  
        <div colspan="2" class="text-center" id="head-manage-club" style="color:#D4AF37;">Administrar Elementos</div>
        <select name="action" id="select-elementos" class="form-select form-select-lg" onchange="this.form.submit()">
            <option value="" disabled selected>Elige el Elemento a Administrar</option> <!-- Opción predeterminada -->
            <option value="insert_elements">Incluir Modalidades-Divisiones-Categorías</option>
            <option value="list_elements">Consultar Categorías</option>
            <option value="delete_elements">Eliminar Elementos</option>
            <option value="lugar_entrenamiento">Lugares de Entrenamiento</option>
        </select>      
    </form>
</div>

<!-- ============================================================================================================================= -->

<link rel="stylesheet" href="css/club_manage.css">
<link rel="stylesheet" href="css/insert_club.css">
<style>
    #head-manage-club{
        background-color: #4A0D0D;
        font-size: 2vw;
        font-family:'Courier New', Courier, monospace;
    }
    #contenedor-elementos{
        background-image: url('./IMG/LTL/dark-mat.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;

        width: 100%;
        height: 30rem;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        }
    #formulario-elementos{
        width: 60%;
        height: 10rem;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #4A0D0D; 
        border: 1px solid #D4AF37;
        border-radius:3px;
    }
    #select-elementos{
        font-size: 1.1rem;
        font-style:italic;
        text-align: center;
        padding:0.3rem;
        margin: 1rem;
        background-color: #DCDCDC;
        font-size: 1.2rem;
    }
</style>
<!-- ============================================================================================== -->