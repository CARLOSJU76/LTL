<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIGA TOLIMENSE DE LUCHA</title>
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/club_manage.css">
    <link rel="stylesheet" href="./css/listar_clubes.css">
    <style>
        .nuevo-div{
            display:flex;
            flex-direction: row;
            justify-content: space-around;
        }
        
        body{
            background-image: url('./IMG/LTL/renteria.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            background-repeat: no-repeat;

        }

    </style>
    
</head>
<body>

<div class="container mt-4" >
    
    <h2>Categorías x Edad</h2>
    <!-- <table class="table table-bordered"> -->
        
            
    <?php 
foreach ($edades as $edad) {
    echo "<table class='table table-bordered'>"
        ."<thead>"
            ."<tr>"
                ."<th>".htmlspecialchars($edad['nombre_Categoria'])."</th>"
            ."</tr>"
        ."</thead>"
        ."<tbody>";

    foreach ($modalidades as $mod) {
        echo "<tr  style='background-color:#FFFFC5;'>"
            ."<td>".htmlspecialchars($mod['modalidad'])."</td>"."</tr><tr><td class='nuevo-div'>";

        foreach ($divisiones as $i=> $divi) {
            $color = ($i % 2 == 0 || $i== 9) ? 'red': 'blue' ; 
            // Compara las condiciones para imprimir los datos correspondientes
            if ($edad['codigo'] == $divi['id_ce'] && $mod['id'] == $divi['id_mod']) {
                if($divi['categoriaxPeso']<100){
                    echo 
                     "<div style='color: $color;'>".htmlspecialchars($divi['categoriaxPeso'])." Kgs.</div>";
                }else{
                    echo 
                     "<div style='color:$color;'> + de ".htmlspecialchars($divi['categoriaxPeso'])." Kgs.</div>";
                }
                 // Asumiendo que "nombre" es el campo que deseas mostrar de las divisiones
                    
            }
        }

   echo"</tr></td>"; // Cierra la fila de modalidad
    }

    echo "</tbody>"
        ."</table>";
}
?>

?>

    <!-- ================================================================================================================ -->

    
    <!-- ========================================================================================================= -->

    <div id="div-botones">
        <form action="index.php?action=elements_manage" method='get' enctype="multipart/form-data" class="form-botones">
                <button type="submit" name="action" value="elements_manage" class="botones">Administrar Elementos</button>
        </form>
        <form action="index.php?action=club_principal" method="get" class="form-botones">
                    <button type="submit" name="action" value="principal" class="botones">Vista Principal</button>
        </form>
    </div>

</div>
</body>
</html>