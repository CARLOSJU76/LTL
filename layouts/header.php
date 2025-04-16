<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi Sitio Web' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
         /* Estilo para ubicar la hora en la parte superior derecha */
         .hora-local {
            position: fixed;
            top: 10px;
            right: 20px;
            background-color: transparent;
            padding: 10px 15px;
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
            font-size: 0.8rem;
            color:white;
            font-style: italic;
        }
    </style>
</head>
<body>
    <header style="background: #4A0D0D; color: gold; padding: 1rem;">
        <h2 style="margin:0;">LTL WebSite</h2> 
        <div class="hora-local">
            <div class="hora" id="horaLocal"></div>
            <div class="fecha" id="fechaLocal"></div>
        </div>
    </header>
    <main style="padding: 2rem;">
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