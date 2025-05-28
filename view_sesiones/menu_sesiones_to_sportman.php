<div class="container mt-4" id="container" >
       
       
        <form action="index.php" method="GET" id="formulario_manage">
            <h3 colspan="2" class="text-center" id="head-manage-club">Sesiones Programadas:</h3>
        
            <div class="form-group">
                    <select name="action" id="select-elementos" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="" disabled selected>Ver Sesiones Programadas</option> <!-- Opción predeterminada -->
                        <option value="list_sessions">Ver todas las Sesiones</option>
                        <option value="list_sessionByFecha">Buscar Sesiones por fecha</option>
                        <option value="list_sessionBySite">Buscar Sesiones por Escenario</option>
                    </select>
            </div>   
        </form>
</div>
<!-- ============================================================================= -->
 
<style>
     #container{
            width: 100%;
            height: 80%;
            background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #formulario_manage{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
            margin-bottom: 5%;
            padding:2rem;
            background-color: #4A0D0D;
            border: 1px solid gold;
            border-radius: 3px;
            width: 50%;
        }
       

        #head-manage-club{
            
            color:#DCDCDC;
            font-size: 2vw;
            font-family:'Courier New', Courier, monospace;
       
            border-radius: 3px;
        }
       
       
      #select-elementos{
        background-color: #DCDCDC;
            font-size: 1.2rem;
            padding: 1rem;
            width: 20rem;
            font-style: italic;
            border: 1px solid gold;
            border-radius: 3px;
        }
    </style>
    
  
    