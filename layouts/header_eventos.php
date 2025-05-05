<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi Sitio Web' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html {
            font-size: 16px;
            width: 100%;
        }
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: start;
            background-color: #4A0D0D;
            color: gold;
            position: relative;
            padding: 1rem;
        }

        /* Botón hamburguesa */
        .menu-toggle {
            display: none;
            font-size: 1.8rem;
            background-color: transparent;
            border: none;
            color: gold;
            cursor: pointer;
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 10000;
        }

        /* Menú de navegación */
        .menu-nav {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Justifica a la izquierda */
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .botones_header {
            background-color: transparent;
            border: gold solid 1px;
            color: gold;
            font-family: 'Courier New', Courier, monospace;
            border-radius: 5px;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            width: 15rem;
            justify-content: flex-start;
            padding: 0.4rem;
            cursor: pointer;
            text-align: center;
        }

        .botones_header:hover {
            background-color: gold;
            color: #4A0D0D;
        }

        .form-botones {
            background-color: transparent;
            margin-right: 1rem;
            padding: 0;
        }

        /* Hora dentro del menú */
        .hora-local {
            background-color: transparent;
            border-radius: 8px;
            color: white;
            text-align: right;
        }

        .hora {
            font-weight: bold;
            font-size: 0.6rem;
            font-style: italic;
        }

        .fecha {
            font-size: 0.7rem;
            font-weight: lighter;
            font-style: italic;
        }

        /* Responsive */
        @media screen and (min-width: 769px) { /*Estilos para pantallas después de 769 pixeles*/
            #header-menu{
                display:flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                
            }
            #menu{
                display:flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                margin-top:1rem;
             
                width: 80%;
            }
           

           
        }

        @media screen and (max-width: 500px) {/*Estilos para pantallas menores que  769 pixeles*/
            html{
                font-size: 8px;
            }
            .menu-toggle {
                display: block;
            }

            .menu-nav {
                display: none;
                flex-direction: column;
                background-color: #4A0D0D;
                padding: 1rem;
                border: 1px solid gold;
                border-radius: 8px;
                top: 4rem;
                right: 1rem;
                z-index: 9999;
            }

            .menu-nav.show {
                display: flex;
            }
           
        }
        @media screen and (min-width: 500px) and (max-width: 768px){
            html{
                font-size: 8px;
            }
            #header-menu{
                display:flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                
            }
            #menu{
                display:flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                margin-top:1rem;
             
                width: 80%;
            }
            
            }
    </style>
</head>
<body>
    <header id="header-menu">
        <h2 style="font-size: 1.2rem;">LTL WebSite</h2>

        <!-- Botón hamburguesa -->
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>

        <!-- Menú de navegación con botones y hora -->
        <nav id="menu" class="menu-nav">
            <form action="index.php?action=event_manage" method="get" class="form-botones">
                <button type="submit" name="action" value="event_manage" class="botones_header">Gestión de Eventos</button>
            </form>
            <form action="index.php?action=club_principal" method="get" class="form-botones">
                <button type="submit" name="action" value="principal" class="botones_header">Vista Principal</button>
            </form>
            <div class="hora-local" id="hora-l">
                <div class="hora" id="horaLocal"></div>
                <div class="fecha" id="fechaLocal"></div>
            </div>
            
        </nav>
       
    </header>

    <main style="padding: 1rem;">
        <!-- Contenido principal aquí -->
    </main>

    <script>
        function actualizarFechaHora() {
            const ahora = new Date();
            const horaFormateada = ahora.toLocaleTimeString();
            const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const fechaFormateada = ahora.toLocaleDateString('es-ES', opcionesFecha);
            document.getElementById('horaLocal').textContent = horaFormateada;
            document.getElementById('fechaLocal').textContent = fechaFormateada;
        }

        // Mostrar hora y fecha al cargar y actualizar cada segundo
        actualizarFechaHora();
        setInterval(actualizarFechaHora, 1000);

        // Función para toggle del menú
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('show');
        }
    </script>
</body>
</html>
