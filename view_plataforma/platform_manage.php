<?php 

?>
<!-- =========================================================================================================================== -->
<div class="container mt-4" id="container" >
       
       
        <form action="index.php" method="GET" id="formulario_manage">
        
            <table class="table" id="tabla_manage">
            <!-- Primera fila: Encabezado -->
                <thead >
                    <tr >
                        <th colspan="2" class="text-center" id="head-manage-club">Administrar Elementos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="action" id="repesentante" class="form-select form-select-lg" onchange="this.form.submit()">
                                    <option value="" disabled selected>Administrar Plataforma</option> <!-- Opción predeterminada -->
                                    <option value="cargar_estados">Cargar Estados Financieros</option>
                                    <option value="update_vision">Actualizar Visión</option>
                                    <option value="update_mision">Actualizar Misión</option>

                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<!-- ============================================================================================================================ -->
       

<!-- ============================================================================================================================= -->

<style>
        #head-manage-club{
            background-color: #7A1F1F;
            font-size: 2vw;
            font-family:'Courier New', Courier, monospace;

        }
        #container{
            width: 95%;
            height: 30rem;
            background-image: url('./IMG/LTL/dark-mat.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;
        }
        #formulario_manage{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
            margin-bottom: 5%;
            background-color: transparent;
            width: 50%;
        }
        #tabla_manage{
            background-color: #4A0D0D;
            color: gold;
            font-family:'Courier New', Courier, monospace;
            width: 80%;
        }
        #representante{
            font-size: 1.2rem;
        }
    </style>
    <link rel="stylesheet" href="CSS/club_manage.css">
  
    