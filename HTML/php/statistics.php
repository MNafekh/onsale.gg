<?php 
	include('autocomplete.php');	
	
	function getDateDiffsForTier($tier) {
		$skins = getSkinsByTier($tier);
		
		$now = new DateTime();
		$now->setTimestamp(time());
		
		$dates = array();
		for ($i = 0; $i < count($skins); $i++) {
			if ($skins[$i][8]) {
				if (strcmp($skins[$i][7],'0000-00-00') !== 0) {
					array_push($dates, $skins[$i][7]);
				} else {
					array_push($dates, $skins[$i][6]);
				}
			}
		}
		
		for ($i = 0; $i < count($dates); $i++) {
			$dateDiffs[$i] = $now->diff(new DateTime($dates[$i]))->format("%a");
		}
		
		return $dateDiffs;
	}
	
	function getDateDiffForSkin($skin) {
		$now = new DateTime();
		$now->setTimestamp(time());
		if (strcmp($skin[7], "Never") !== 0  && strcmp($skin[7], "0000-00-00") !== 0)
			$dateDiff = $now->diff(new DateTime($skin[7]))->format("%a");
		else
			$dateDiff = $now->diff(new DateTime($skin[6]))->format("%a");
		
		return $dateDiff;
	}
	
	function getMeanDateDiffForTier($tier) {
		$dateDiffs = getDateDiffsForTier($tier);
		
		$mean = floor(array_sum($dateDiffs) / count($dateDiffs));
		
		return $mean;
	}
	
	function getStdDevForTier($tier) {
		$dateDiffs = getDateDiffsForTier($tier);
		$mean = getMeanDateDiffForTier($tier);
		
		$devs = array();
		
		for ($i = 0; $i < count($dateDiffs); $i++) {
			$devs[$i] = pow($dateDiffs[$i] - $mean, 2);
		}
		
		$stdDev = floor(sqrt(array_sum($devs) / count($devs)));
		
		return $stdDev;
	}
	
	function getSkinSaleEstimate($skin) {
		$skinDateDiff = getDateDiffForSkin($skin);
		$tierDateDiff = getMeanDateDiffForTier($skin[4]);
		$stdDev = getStdDevForTier($skin[4]);
		
		$estimation = "";
		if ($skinDateDiff < $tierDateDiff) {
			$estimation = "No sale anytime soon";
		} else {
			if ($skinDateDiff < ($tierDateDiff + $stdDev)) {
				$estimation = "Could be on sale soon";
			} else {
				$estimation = "RITO PLS";
			}
		}
		
		return $estimation;
	}
	
	function getMostRecentSkins() {
		$conn = getConnection();
		
		$skinQuery = "SELECT * FROM skins ORDER BY released DESC LIMIT 20";
		$skinResult = $conn->query($skinQuery);
		$skins = array();
		
		for ($i = 0; $i < $skinResult->num_rows; $i++) {
			$row = $skinResult->fetch_assoc();
			array_push($skins[$i], $row);
		}
		
		$conn->close();
		return $skins;
	}
	
?>