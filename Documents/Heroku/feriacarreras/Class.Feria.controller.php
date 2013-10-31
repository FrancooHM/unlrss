<?php

class FeriaController {

	function getTest($id_conjunto){
		$feriaModel = new FeriaModel();
		$conjunto = $feriaModel->getConjunto($id_conjunto);

	// ------------------ Obtengo id de pares  ------------------ 
		$id_par1 = $conjunto["id_par1"];
		$id_par2 = $conjunto["id_par2"];
		$id_par3 = $conjunto["id_par3"];
		$id_par4 = $conjunto["id_par4"];
		$id_par5 = $conjunto["id_par5"];
		$id_par6 = $conjunto["id_par6"];


	// ------------------ Obtengo id de diadas  ------------------ 
		$par1 = $feriaModel->getPar($id_par1);	
		$par2 = $feriaModel->getPar($id_par2);	
		$par3 = $feriaModel->getPar($id_par3);	
		$par4 = $feriaModel->getPar($id_par4);
		$par5 = $feriaModel->getPar($id_par5);		
		$par6 = $feriaModel->getPar($id_par6);	


	// ------------------ Obtengo diadas completas  ------------------ 
		$diada1 = $feriaModel->getDiada($par1["id_pregunta1"]);
		$diada2 = $feriaModel->getDiada($par1["id_pregunta2"]);
		$diada3 = $feriaModel->getDiada($par2["id_pregunta1"]);
		$diada4 = $feriaModel->getDiada($par2["id_pregunta2"]);
		$diada5 = $feriaModel->getDiada($par3["id_pregunta1"]);
		$diada6 = $feriaModel->getDiada($par3["id_pregunta2"]);
		$diada7 = $feriaModel->getDiada($par4["id_pregunta1"]);
		$diada8 = $feriaModel->getDiada($par4["id_pregunta2"]);
		$diada9 = $feriaModel->getDiada($par5["id_pregunta1"]);
		$diada10 = $feriaModel->getDiada($par5["id_pregunta2"]);
		$diada11 = $feriaModel->getDiada($par6["id_pregunta1"]);
		$diada12 = $feriaModel->getDiada($par6["id_pregunta2"]);

	// ------------------ Obtengo descripcion de diadas  ------------------ 
		$diada[1] = $diada1["pregunta"];
		$diada[2] = $diada2["pregunta"];
		$diada[3] = $diada3["pregunta"];
		$diada[4] = $diada4["pregunta"];
		$diada[5] = $diada5["pregunta"];
		$diada[6] = $diada6["pregunta"];
		$diada[7] = $diada7["pregunta"];
		$diada[8] = $diada8["pregunta"];
		$diada[9] = $diada9["pregunta"];
		$diada[10] = $diada10["pregunta"];
		$diada[11] = $diada11["pregunta"];
		$diada[12] = $diada12["pregunta"];
	// ------------------ Obtengo area de diadas  ------------------ 
		$diada[13] = $diada1["id_area"];
		$diada[14] = $diada2["id_area"];
		$diada[15] = $diada3["id_area"];
		$diada[16] = $diada4["id_area"];
		$diada[17] = $diada5["id_area"];
		$diada[18] = $diada6["id_area"];
		$diada[19] = $diada7["id_area"];
		$diada[20] = $diada8["id_area"];
		$diada[21] = $diada9["id_area"];
		$diada[22] = $diada10["id_area"];
		$diada[23] = $diada11["id_area"];
		$diada[24] = $diada12["id_area"];

		return $diada;
	}

	function getDescArea($id_area){
		$feriaModel = new FeriaModel();
		$area = $feriaModel->getDescArea($id_area);
		$descArea = $area["area"];
		return $descArea;
	}

	function getParDesempate($tipo1,$tipo2){
		$feriaModel = new FeriaModel();
		$par = $feriaModel->getParDesempate($tipo1,$tipo2);

		$diada1 = $feriaModel->getDiada($par["id_pregunta1"]);
		$diada2 = $feriaModel->getDiada($par["id_pregunta2"]);

		//Diada
		$diada[1] = $diada1["pregunta"];
		$diada[2] = $diada2["pregunta"];
		//Area
		$diada[3] = $diada1["id_area"];
		$diada[4] = $diada2["id_area"];

		return $diada;
	}

	function insertarJugador($id_area,$genero){
		$feriaModel = new FeriaModel();
		$insert = $feriaModel->insertarJugador($id_area,$genero);
		return $insert;
	}
}
?>