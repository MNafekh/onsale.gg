<?php 

	include "database.php";
	
	function getNames() {
		$names = array();
		
		$champs = getChampArray();
		$skins = getSkinArray();
		
		for ($i = 0; $i < count($champs); $i++) {
			array_push($names, $champs[$i][1]);
		}
		for ($i = 0; $i < count($skins); $i++) {
			array_push($names, $skins[$i][1]);
		}
		echo json_encode($names);
	}
?>