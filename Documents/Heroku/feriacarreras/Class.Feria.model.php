<?php

class FeriaModel {
	function getParDesempate($tipo1,$tipo2){
		global $db;

		// ------------------ Obtengo diada  ------------------ 
		$sql = "SELECT * FROM Pares Pares1 INNER JOIN Preguntas Preguntas1
			ON Pares1.id_pregunta1 = Preguntas1.id_pregunta
			WHERE Preguntas1.id_area = " . $tipo1 . "
			AND Pares1.id_pregunta2 IN (
				SELECT Pares2.id_pregunta2 FROM Pares Pares2 INNER JOIN Preguntas Preguntas2
				ON Pares2.id_pregunta2 = Preguntas2.id_pregunta
				WHERE Preguntas2.id_area = ".$tipo2.")";

		$result = $db->select($sql);

		return $result[0];
	}


	function getDescArea($id_area){
		global $db;

		// ------------------ Obtengo diada  ------------------ 
		
		$sql = "SELECT * FROM Area WHERE id_area = '".$id_area. "'";
		$result = $db->select($sql);

		return $result[0];
	}

	function getDiada($id_diada){	
		
		global $db;

		// ------------------ Obtengo diada  ------------------ 
		
		$sql = "SELECT * FROM Preguntas WHERE id_pregunta = '".$id_diada. "'";
		$result = $db->select($sql);

		return $result[0];
	}

	function getPar($id_par){	

		global $db;
		
		// ------------------ Obtengo par ------------------ 
		
		$sql = "SELECT * FROM Pares WHERE id_par = '".$id_par. "'";
		$result = $db->select($sql);

		return $result[0];
	}


	function getConjunto($id_conjunto){
		
		global $db;
		
		// ------------------ Conjunto de id de pares  ------------------ 
		
		$sql = "SELECT * FROM Conjuntos WHERE id_conjunto = '".$id_conjunto. "'";
		$result = $db->select($sql);
		
		return $result[0];
	}

	function insertarJugador($resultado,$genero){
		global $db;
		
		// ------------------ Conjunto de id de pares  ------------------ 
		
		$sql = "INSERT INTO Jugador (sexo, resultado) VALUES ('".$genero."','" .$resultado."')";
		$result = $db->select($sql);
		
		return $result[0];
	}

}
?>