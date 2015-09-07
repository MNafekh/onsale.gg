<?php 

	include('database.php');
	
	$champs = getChampArray();
	$skins = getSkinArray();
	
	for ($i = 120; $i < count($champs); $i++) {
		$champName = $champs[$i][2];
		$champId = $champs[$i][0];
		$champSkins = getSkinsByChampId($champId);
		
		$url = 'http://ddragon.leagueoflegends.com/cdn/5.16.1/img/champion/' . $champName . '.png';
		$path = '../images/champion/' . $champName . '.png';
		copy($url, $path);
		echo $url . '::' . $path . '::';
		
		$url = 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/' . $champName . '_0.jpg';
		$path = '../images/champion/splash/' . $champName . '_0.jpg';
		copy($url, $path);
		echo $url . '::' . $path . '::';
		
		$url = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' . $champName . '_0.jpg';
		$path = '../images/champion/loading/' . $champName . '_0.jpg';
		copy($url, $path);
		echo $url . '::' . $path . '::';
				
		for ($j = 0; $j < count($champSkins); $j++) {
			$splashNum = $champSkins[$j][3];
			
			$url = 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/' . $champName . '_' . $splashNum . '.jpg';
			$path = '../images/champion/splash/' . $champName . '_' . $splashNum . '.jpg';
			copy($url, $path);
			echo $url . '::' . $path . '::';
			
			$url = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' . $champName . '_' . $splashNum . '.jpg';
			$path = '../images/champion/loading/' . $champName . '_' . $splashNum . '.jpg';
			copy($url, $path);
			echo $url . '::' . $path . '::';
		}
	}
	
?>
	