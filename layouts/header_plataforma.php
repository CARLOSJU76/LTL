
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi Sitio Web' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
           html{
            font-size: 16px; /* Tamaño de fuente base */
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
    
        }
        header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: start;
            background-color: #4A0D0D;/* Color de fondo del header */
            color: gold; 
            position: relative;
         
        }
     
         /* Estilo para ubicar la hora en la parte superior derecha */
         .hora-local {
            position: absolute;
            top: 10px;
            right: 20px;
            background-color: transparent;
       
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        
            font-family: Arial, sans-serif;
            z-index: 9999;
            text-align: right;
        }
        .hora {
            font-weight: bold;
            font-size: 1rem;
            color: white;
            font-style: italic;
        }
        .fecha {
            font-size: 1.2rem;
            font-weight: lighter;
            color:white;
            font-style: italic;
        }
        #div-botones_header{
            display: flex;
            justify-content: center;
            align-items: center;  
            background-color: transparent;
            position:absolute;
            right: 45%;
         top:1rem;
            
            width: 10%;

        }
        .botones_header {
            background-color: transparent;
            border: gold solid 1px;
            color: gold;
            font-family: 'Courier New', Courier, monospace;
            border-radius: 5px;
            font-size:0.8rem;
            margin-right:0.5rem;
            width: 15rem;
            justify-content: center;
            padding: 0.4rem;
            cursor: pointer;
        }
        .form-botones {
            background-color: transparent; /* Elimina el margen del formulario */
        }
        .botones_header:hover {
            background-color: gold;
            color: #4A0D0D; /* Cambia el color del texto al pasar el mouse */
        }
    </style>
</head>
<body>
    <header>
        <h2 style=" font-size: 1.5rem;">LTL WebSite</h2> 

        <div id="div-botones_header">
                <form action="index.php?action=platform_manage" method="get" class="form-botones">
                    <button type="submit" name="action" value="platform_manage" class="botones_header">Administrar Plataforma</button>
                </form>
                <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones_header">Vista Principal</button>
                </form>
        </div>
        <div class="hora-local">
            <div class="hora" id="horaLocal"></div>
            <div class="fecha" id="fechaLocal"></div>
        </div>
    </header>
    <main style="padding: 1rem;">
    

    <script>
        function actualizarFechaHora() {
            const ahora = new Date();

            // Formato de hora local
            const horaFormateada = ahora.toLocaleTimeString();

            // Formato de fecha local (puedes personalizarlo)
            const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const fechaFormateada = ahora.toLocaleDateString('es-ES', opcionesFecha);

            // Actualizar en el DOM
            document.getElementById('horaLocal').textContent = horaFormateada;
            document.getElementById('fechaLocal').textContent = fechaFormateada;
        }

        // Mostrar al cargar
        actualizarFechaHora();

        // Actualizar cada segundo
        setInterval(actualizarFechaHora, 1000);
    </script>
    </body>
    </html>