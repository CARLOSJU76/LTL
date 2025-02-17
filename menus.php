<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Desplegable Dinámico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .menu {
            display: flex;
            gap: 20px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 150px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            border: 1px solid #ddd;
        }
        .dropdown-content div {
            padding: 10px;
            cursor: pointer;
        }
        .dropdown-content div:hover {
            background-color: #f1f1f1;
        }
        .selected {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>

    <h2>Seleccione una Ciudad</h2>
    <div class="menu">
        <div class="dropdown" id="paisDropdown">
            <button>Pais</button>
            <div class="dropdown-content" id="paisList"></div>
        </div>
        <div class="dropdown" id="departamentoDropdown">
            <button>Departamento</button>
            <div class="dropdown-content" id="departamentoList"></div>
        </div>
        <div class="dropdown" id="ciudadDropdown">
            <button>Ciudad</button>
            <div class="dropdown-content" id="ciudadList"></div>
        </div>
    </div>

    <h3 id="resultado"></h3>

    <script>
        // Datos simulados de las tablas PAIS, DEPARTAMENTO y CIUDAD
        const paises = [
            { id: 1, nombre: "Colombia" },
            { id: 2, nombre: "Argentina" }
        ];

        const departamentos = [
            { id: 1, id_pais: 1, nombre: "Antioquia" },
            { id: 2, id_pais: 1, nombre: "Cundinamarca" },
            { id: 3, id_pais: 2, nombre: "Buenos Aires" }
        ];

        const ciudades = [
            { id: 1, id_departamento: 1, nombre: "Medellín" },
            { id: 2, id_departamento: 1, nombre: "Envigado" },
            { id: 3, id_departamento: 2, nombre: "Bogotá" },
            { id: 4, id_departamento: 3, nombre: "La Plata" },
            { id: 5, id_departamento: 3, nombre: "Mar del Plata" }
        ];

        // Elementos del DOM
        const paisList = document.getElementById("paisList");
        const departamentoList = document.getElementById("departamentoList");
        const ciudadList = document.getElementById("ciudadList");
        const resultado = document.getElementById("resultado");

        let paisSeleccionado = null;
        let departamentoSeleccionado = null;

        // Cargar Paises en el menú
        paises.forEach(pais => {
            let div = document.createElement("div");
            div.textContent = pais.nombre;
            div.dataset.id = pais.id;
            div.addEventListener("mouseover", function () {
                cargarDepartamentos(pais.id);
            });
            paisList.appendChild(div);
        });

        // Cargar Departamentos segun el País seleccionado
        function cargarDepartamentos(id_pais) {
            paisSeleccionado = paises.find(p => p.id === id_pais);
            departamentoList.innerHTML = ""; // Limpiar anterior
            ciudadList.innerHTML = ""; // Limpiar ciudades

            departamentos.filter(dep => dep.id_pais === id_pais)
                .forEach(dep => {
                    let div = document.createElement("div");
                    div.textContent = dep.nombre;
                    div.dataset.id = dep.id;
                    div.addEventListener("mouseover", function () {
                        cargarCiudades(dep.id);
                    });
                    departamentoList.appendChild(div);
                });

            document.getElementById("departamentoDropdown").style.display = "inline-block";
        }

        // Cargar Ciudades segun el Departamento seleccionado
        function cargarCiudades(id_departamento) {
            departamentoSeleccionado = departamentos.find(dep => dep.id === id_departamento);
            ciudadList.innerHTML = ""; // Limpiar ciudades previas

            ciudades.filter(ciudad => ciudad.id_departamento === id_departamento)
                .forEach(ciudad => {
                    let div = document.createElement("div");
                    div.textContent = ciudad.nombre;
                    div.dataset.id = ciudad.id;
                    div.addEventListener("click", function () {
                        seleccionarCiudad(ciudad);
                    });
                    ciudadList.appendChild(div);
                });

            document.getElementById("ciudadDropdown").style.display = "inline-block";
        }

        // Seleccionar Ciudad y mostrar resultado
        function seleccionarCiudad(ciudad) {
            resultado.innerHTML = `Seleccionado: <span class="selected">${paisSeleccionado.nombre}</span> > 
                                   <span class="selected">${departamentoSeleccionado.nombre}</span> > 
                                   <span class="selected">${ciudad.nombre}</span>`;
        }

        // Mostrar menú de países al pasar el mouse
        document.getElementById("paisDropdown").addEventListener("mouseover", function () {
            paisList.style.display = "block";
        });

        document.getElementById("departamentoDropdown").addEventListener("mouseover", function () {
            departamentoList.style.display = "block";
        });

        document.getElementById("ciudadDropdown").addEventListener("mouseover", function () {
            ciudadList.style.display = "block";
        });

        // Ocultar menús cuando el mouse no está sobre ellos
        document.addEventListener("mouseover", function (event) {
            if (!event.target.closest(".dropdown")) {
                paisList.style.display = "none";
                departamentoList.style.display = "none";
                ciudadList.style.display = "none";
            }
        });
    </script>

</body>
</html>
