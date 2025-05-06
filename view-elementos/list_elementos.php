<div id="fondo-categorias">
    <div class="container mt-4" id="div-categorias">
    <h2>Categorías x Edad</h2>
    <?php 
        foreach ($edades as $edad) {
            echo "<table class='table table-bordered'>"
                    ."<thead>"
                        ."<tr>"
                            ."<th>".htmlspecialchars($edad['categoria'])."</th>"
                        ."</tr>"
                    ."</thead>"
                    ."<tbody>";

                        foreach ($modalidades as $mod) {
                            echo "<tr  style='background-color:#FFFFC5;'>"
                                    ."<td>".htmlspecialchars($mod['modalidad'])."</td>"."</tr><tr><td class='nuevo-div'>";


                        $array=[];
                        foreach($divisiones as $elemento3){
                            if($elemento3['id_mod']==$mod['id'] && $edad['id']==$elemento3['id_ce']){
                                array_push($array, $elemento3);
                            }
                        }   


        foreach ($array as $i=> $divi) {
            $color = (($i % 2 == 0 || $i== 9) && ($edad['id']==8)) ? 'red': 'blue' ; 
            // Compara las condiciones para imprimir los datos correspondientes
            if ($mod['id'] == $divi['id_mod']) {
                if($divi['categoriaxPeso']<100){
                    echo 
                     "<div style='color: $color;'>".htmlspecialchars($divi['categoriaxPeso'])." Kgs.</div>";
                }else{
                    echo 
                     "<div style='color:$color;'>".htmlspecialchars($divi['categoriaxPeso'])." Kgs.</div>";
                }     
            }
        }
                            echo"</tr></td>"; 
                        }   
            echo "</tbody>"
            ."</table>";
        }
    ?>
    </div>
</div>
<!-- ======================================================================================================================== -->
<link rel="stylesheet" href="./css/club_manage.css">
<link rel="stylesheet" href="./css/listar_clubes.css">
<style>
    .nuevo-div{
        display:flex;
        flex-direction: row;
        justify-content: space-around;
    }
        
    #fondo-categorias{
        background-image: url('./IMG/LTL/renteria.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-position: center center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
        background-repeat: no-repeat;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        }
    #div-categorias{
        background-color:  #4A0D0D;
        border: 2px solid #D4AF37;
        border-radius: 4px;
        margin: 3rem; 
    }
</style>