<?php
// ------------------ cargarTest.php ------------------ 
//=================================================================================
// OPEN SESSION 

session_start();

$_SESSION["genero"] = $_POST["genero"];

//=================================================================================
// INCLUDES 
include("inc.includes.php");

//=================================================================================
// OPEN CONNECTION 
if($config["dbEngine"]=="MYSQL")
$db=new MySQL($config["dbhost"],$config["dbuser"],$config["dbpass"],$config["db"]); 
$feriaController = new FeriaController();

$diada = $feriaController->getTest(rand(1,6));

// ------------------ Cada php hace echo de un test diferente ------------------

echo
'                   
                    <div id="contenedorPares">
                        <h2 id = "diada1"><div class="center">'.$diada[1].'</div><h3 id = "areaDiada1">'.$diada[13].'</h3></h2>
                        <h2 id = "diada2"><div class="center">'.$diada[2].'</div><h3 id = "areaDiada2">'.$diada[14].'</h3></h2>
                        <h2 id = "diada3"><div class="center">'.$diada[3].'</div><h3 id = "areaDiada3">'.$diada[15].'</h3></h2>
                        <h2 id = "diada4"><div class="center">'.$diada[4].'</div><h3 id = "areaDiada4">'.$diada[16].'</h3></h2>
                        <h2 id = "diada5"><div class="center">'.$diada[5].'</div><h3 id = "areaDiada5">'.$diada[17].'</h3></h2>
                        <h2 id = "diada6"><div class="center">'.$diada[6].'</div><h3 id = "areaDiada6">'.$diada[18].'</h3></h2>
                        <h2 id = "diada7"><div class="center">'.$diada[7].'</div><h3 id = "areaDiada7">'.$diada[19].'</h3></h2>
                        <h2 id = "diada8"><div class="center">'.$diada[8].'</div><h3 id = "areaDiada8">'.$diada[20].'</h3></h2>
                        <h2 id = "diada9"><div class="center">'.$diada[9].'</div><h3 id = "areaDiada9">'.$diada[21].'</h3></h2>
                        <h2 id = "diada10"><div class="center">'.$diada[10].'</div><h3 id = "areaDiada10">'.$diada[22].'</h3></h2>
                        <h2 id = "diada11"><div class="center">'.$diada[11].'</div><h3 id = "areaDiada11">'.$diada[23].'</h3></h2>
                        <h2 id = "diada12"><div class="center">'.$diada[12].'</div><h3 id = "areaDiada12">'.$diada[24].'</h3></h2>           
                   </div>
'

?>