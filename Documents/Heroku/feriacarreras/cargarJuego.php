<?php
// ------------------ cargarJuego.php ------------------ 

//=================================================================================
// INCLUDES 
include("inc.includes.php");

//=================================================================================
// OPEN CONNECTION 
if($config["dbEngine"]=="MYSQL")
$db=new MySQL($config["dbhost"],$config["dbuser"],$config["dbpass"],$config["db"]); 

// ------------------ Cada php hace echo de un test diferente ------------------

echo
'                   
<div id="contenedorGeneros">
    <h2 id = "varon">
        <div class="center">varón</div>
    </h2>
    <h2 id = "mujer">
        <div class="center" >mujer</div>
            </h2>            
        </div>
</div>
'

?>