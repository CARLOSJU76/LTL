<div class="container mt-4" id="contenedor-elementos" >
    <div id="div-h2"><h3>LTL Website</h3></div>
        <!-- Formulario dentro de una tabla centrada -->
       
    <form action="index.php" method="GET" id="formulario-elementos">  
        <div colspan="2" class="text-center" id="head-manage-club" style="color:#D4AF37;">Gestión de Clubes</div>
        <select name="action" id="select-elementos" class="form-select form-select-lg" onchange="this.form.submit()">
        <option value="" disabled selected>Gestión de Deportistas</option> <!-- Opción predeterminada -->
                <option value="list_deportista">Consultar Deportistas</option>
                <option value="list_entrenador">Consultar Entrenadores</option>
                <option value="insert_deportista">Incluir Deportista</option>
                <option value="insert_entrenador">Incluir Entrenador</option>
                <option value="rankingx_eventos">Puntajes por Eventos</option>       
                <option value="rankingx_asistencias">Puntajes por Asistencias</option>       
        </select>      
    </form>
</div>
<!-- =========================================================================================================================== -->
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
        border: 1px solid #D4AF37;/*dorado*/
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