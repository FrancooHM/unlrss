<?php
// ------------------ cargarResultado.php ------------------ 
session_start();

//=================================================================================
// INCLUDES 
include("inc.includes.php");

//=================================================================================
// OPEN CONNECTION 
if($config["dbEngine"]=="MYSQL")
$db=new MySQL($config["dbhost"],$config["dbuser"],$config["dbpass"],$config["db"]); 

$feriaController = new FeriaController();
$descArea = $feriaController->getDescArea($_POST["area"]);
$insert = $feriaController->insertarJugador($_POST["area"],$_SESSION["genero"]);


//=================================================================================
// CIERRO SESION
unset($_SESSION["genero"]);
session_destroy();

echo
'<!-------------------- contenedorResultados --------------------> 

                    <div id="contenedorResultados">
                        <h2 id = "resultado">'.$descArea.'</h2>  
                   </div>
'



?>