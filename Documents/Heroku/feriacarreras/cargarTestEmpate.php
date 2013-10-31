<?php
// ------------------ cargarTestEmpate.php ------------------ 

session_start();
//=================================================================================
// INCLUDES 
include("inc.includes.php");

//=================================================================================
// OPEN CONNECTION 
if($config["dbEngine"]=="MYSQL")
$db=new MySQL($config["dbhost"],$config["dbuser"],$config["dbpass"],$config["db"]); 

$feriaController = new FeriaController();

$diada = $feriaController->getParDesempate($_POST["area1"],$_POST["area2"]);

// ------------------ Cada php hace echo de un test diferente ------------------

echo
'
                   	<div id="contenedorPares">
                        <h2 id = "diada13"><div class="center">'.$diada[1].'</div><h3 id = "areaDiada13">'.$diada[3].'</h3></h2>
                        <h2 id = "diada14"><div class="center">'.$diada[2].'</div><h3 id = "areaDiada14">'.$diada[4].'</h3></h2>      
                   	</div>
'

?>