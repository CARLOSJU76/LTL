<div id="fondo-inserc">
<!-- =================================================================================================================================== -->
    <div class="container mt-4" id="contenedor-general">
        <div id="div-h2"><h3>LTL Website</h3></div>
        <!-- Formulario dentro de una tabla centrada -->
        <form action="index.php?action=insert_Club" method="post" id="formulario_inserclubes">
        
            <table class="table" id="tabla_inser_clubes">
            <!-- Primera fila: Encabezado -->
                <thead >
                    <tr >
                        <th colspan="2" class="text-center" id="head-inser_club">Formulario inserción de clubes</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Segunda fila: Campos del formulario -->
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" name="nombre_club" id="nombre_club" placeholder="Nombre del Club" class="form-control" required>
                            </div>
                        </td>
                    </tr>
           
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="representante" id="representante" class="form-select" required>
                                    <option value="">Elija el Representante</option>
                                    <?php 
                                    include_once('./controller/ClubController.php');
                                    $rep1 = new ClubController();
                                    $arrayRep = $rep1->getRepresentante();
                                    foreach($arrayRep as $repre){
                                        echo "<option value='".htmlspecialchars($repre['id'] ?? '')."'>"
                                        .htmlspecialchars($repre['nombres'] ?? '')." ".htmlspecialchars($repre['apellidos'] ?? '')."</option>";
                                    }
                                
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="date" id="fecha_conformacion" name="fecha_conformacion" class="form-control" required>
                            </div>
                        </td>
                    </tr>
           
            
                    <!-- Tercera fila: Botón de submit -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-custom" id="boton_submit">Guardar Datos</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
    <!-- ============================================================================================================================== -->
<link rel="stylesheet" href="CSS/bootstrap.min.css"  integrity="sha384-KyZXEJx3W1m9vW8zLKG5odMpgqj75y5y2auKZG2K5REs5tPujVgR0w9r6fO4k5PQ" crossorigin="anonymous">
<style>
    #fondo-inserc{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 30rem;

        background-image: url('./IMG/LTL/mat.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;
    }
</style>
<!-- =============================================== -->
 <style>
    .form-select{
    border: 3px solid white ;
    padding-top:0;
}
#tabla_inser_clubes{
    background-color: whitesmoke;
    width:100%;
}
#formulario_inserclubes{
    margin-top: 3%;
    width: 90%;
    height: 90%;
    background-color: green;
}
#boton_submit{
    grid-row:6/7;
    grid-column: 3/7;
    background: linear-gradient(to bottom, #ffd700, white);
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
    border-radius: 5px;
    font-family:'Courier New', Courier, monospace;
    font-size: 1.2vw;
   font-weight: bold;
    color:#4A0D0D;
}
#head-inser_club{
    background-color: #4A0D0D;;
}
.form-control, .form-select{
    width: 80%;
    margin-bottom: 1%;
    text-justify: center;
    font-family:'Courier New', Courier, monospace
}
h3{
    margin-bottom: 0;
    color:gold;
    font-family:'Courier New', Courier, monospace;
    font-style: italic;
    padding:0;
 }
 #div-h2{
    width: 100%;
    display:flex;
    justify-content: start;
    
 }
 </style>
 <!-- ===============================CLUB  -->
 <style>
 .container {
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    width: 60%;
    background-color: #4A0D0D;
   border-radius: 4px;
    padding: 20px;
    border: 2px solid #D4AF37;
    padding-top:0;
}

h1 {
    color: #4A0D0D;; /* Verde militar */
    font-family: 'calibri', sans-serif;
}

.table {
    width: 100%;
    background-color: white;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.table th {
    background-color: #4A0D0D;;/* Verde militar */
    color: white;
    border-radius: 7px;
}

.table th, .table td {
    text-align: center;
    padding: 15px;
    font-size: 1rem;
}

.table-bordered {
    border: 1px solid #ddd;
}

.btn-custom {
    background-color: #4A0D0D;;;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border: none;
}

.btn-custom:hover {
    background-color: #3c421c;
}

form {
    margin-top: 20px;
}

button {
    background-color: #4A0D0D;;;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    padding: 0.5rem 1.5rem;
    border: none;
}

button:hover {
    background-color: #3c421c;
}
input, select {
    padding: 0.5rem;
    font-size: 1.2rem;
    border-radius: 7px;
}
.form-control, .form-select{
    width: 80%;
    font-size: small;
    margin:0;
}
.btn-custom{
    width: 70%;
}
#div-botones{
    display: flex;
    flex-direction: row;
    justify-content:center;
    align-items: center;
    margin-top:3%;
    margin-bottom:1%;    
    width:90%;
    
    height: 2.5vw;
    padding:0;
}


.botones{  
        
            background: linear-gradient(to bottom, #ffd700, white);
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(0, 120, 215, 0.5); 
            border-radius: 5px;
            font-family:'Courier New', Courier, monospace;
            font-size: 1vw;
            color:#4A0D0D;
           height:100%;
}
.for_up_club{
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
   
    width: 90%;
}
#div_up_club1, #div_up_club2, #div_up_club3, #div_up_club4{
    display:flex;
    flex-direction: column;
    justify-content:center;
    align-items: center;
    width: 90%;
    height: 30%;
}
th{
    background-color: #4A0D0D;;
}
</style>

