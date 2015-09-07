<?php
	
	function getConnection() {
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "onsale";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		
		return $conn;
	}
	
	function getChampArray() {
		
		$conn = getConnection();
		
		//Store champion names and IDs in an array
	    $champQuery = "SELECT champion_id, champion_name, price_ip, price_rp, release_date, last_on_sale FROM champions ORDER BY champion_name";
	    $champResult = $conn->query($champQuery);
	    $champArray = array();
	    for ($i=0;$i<$champResult->num_rows;$i++) {
	        $row = $champResult->fetch_assoc();
	        $champArray[$i][0] = $row["champion_id"];
	        $champArray[$i][1] = $row["champion_name"];
	        if (!in_array($row["champion_name"],array("Wukong","Cho'Gath","Kha'Zix","Vel'Koz","Fiddlesticks","LeBlanc"))) {
	            $champArray[$i][2] = str_replace(array('.',' ','\''), '', $row["champion_name"]);
	        } else if (strcmp($row["champion_name"], "Cho'Gath") == 0) {
	            $champArray[$i][2] = "Chogath";
	        } else if (strcmp($row["champion_name"], "Wukong") == 0) {
	            $champArray[$i][2] = "MonkeyKing";
	        } else if (strcmp($row["champion_name"], "Kha'Zix") == 0) {
	            $champArray[$i][2] = "Khazix";
	        } else if (strcmp($row["champion_name"], "Vel'Koz") == 0) {
	            $champArray[$i][2] = "Velkoz";
	        } else if (strcmp($row["champion_name"], "Fiddlesticks") == 0) {
	            $champArray[$i][2] = "FiddleSticks";
	        } else if (strcmp($row["champion_name"], "LeBlanc") == 0) {
	            $champArray[$i][2] = "Leblanc";
	        }
	        $champArray[$i][3] = $row["price_ip"];
	        $champArray[$i][4] = $row["price_rp"];
	        $champArray[$i][5] = $row["release_date"];
	        $champArray[$i][6] = $row["last_on_sale"];
	    }
		$conn->close();
		return $champArray;
	}
	
	function getSkinArray() {
		$conn = getConnection();
		
		$skinQuery = "SELECT * FROM skins ORDER BY champion_id, splash_num";
		$skinResult = $conn->query($skinQuery);
		$skinArray = array();
		for ($i=0;$i<$skinResult->num_rows;$i++) {
			$row = $skinResult->fetch_assoc();
			$skinArray[$i][0] = $row["skin_id"];
			$skinArray[$i][1] = $row["skin_name"];
			$skinArray[$i][2] = $row["champion_id"];
			$skinArray[$i][3] = $row["splash_num"];
			$skinArray[$i][4] = $row["tier"];
			$skinArray[$i][5] = $row["sale_price"];
			$skinArray[$i][6] = $row["released"];
			$skinArray[$i][7] = $row["last_on_sale"];
			$skinArray[$i][8] = $row["available"];
			$skinArray[$i][9] = $row["comment"];
		}
		$conn->close();
		return $skinArray;
	}
	
	function getTierArray() {
		$conn = getConnection();
		
		$tierQuery = "SELECT * FROM pricing";
		$tierResult = $conn->query($tierQuery);
		$tierArray = array();
		for ($i=0;$i < $tierResult->num_rows; $i++) {
			$row = $tierResult->fetch_assoc();
			$tierArray[$i][0] = $row["tier"];
			$tierArray[$i][1] = $row["cost"];
		}
		$conn->close();
		return $tierArray;
	}
	
	function searchChampions($term) {
		$conn = getConnection();
		
		$searchResult = array();
		
		if ($searchQuery = $conn->prepare("SELECT * FROM champions WHERE champion_name like ?")) {
		
			$searchQuery->bind_param("s", $term);
			
			$searchQuery->execute();
			
			$result = $searchQuery->get_result();
			
			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				$searchResult[$i] = $row;
				//echo "Champion result is " . $searchResult[$i]['champion_name'] . "\n";
			}
			
			$searchQuery->close();
		}
		$conn->close();
		return $searchResult;
	}
	
	function searchSkins($term) {
		$conn = getConnection();
		
		$searchResult = array();
		
		if ($searchQuery = $conn->prepare("SELECT * FROM skins WHERE skin_name like ?")) {
		
			$searchQuery->bind_param("s", $term);
			
			$searchQuery->execute();
			
			$result = $searchQuery->get_result();
			
			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				$searchResult[$i] = $row;
				//echo "Skin result is " . $searchResult[$i]['skin_name'] . "\n";
			}
			
			$searchQuery->close();
		}
		$conn->close();
		return $searchResult;
	}
	
	function getPriceByTier($tier) {
		$tierArray = getTierArray();
		for ($i = 0; $i < count($tierArray); $i++) {
			if (strcmp($tierArray[$i][0],$tier) === 0) {
				return $tierArray[$i][1];
			}
		}
	}
	
	function getChampImgByName($champ) {
		$champArray = getChampArray();
		for ($i = 0; $i < count($champArray); $i++) {
			if (strcmp($champArray[$i][1],$champ) === 0) {
				return $champArray[$i][2];
			}
		}
	}
	
	function getChampImgById($id) {
		$champArray = getChampArray();
		for ($i = 0; $i < count($champArray); $i++) {
			if (strcmp($champArray[$i][0],$id) === 0) {
				return $champArray[$i][2];
			}
		}
	}
	
	function getChampById($id) {
		$champArray = getChampArray();
		for ($i = 0; $i < count($champArray); $i++) {
			if (strcmp($champArray[$i][0],$id) === 0) {
				return $champArray[$i];
			}
		}
	}
	
	function getChampIds() {
		$champArray = getChampArray();
		$ids = array();
		for ($i = 0; $i < count($champArray); $i++) {
			array_push($ids, $champArray[$i][0]);
		}
		return $ids;
	}
	
	function getChampByName($name) {
		$champArray = getChampArray();
		for ($i = 0; $i < count($champArray); $i++) {
			if (strcmp($champArray[$i][1],$name) === 0) {
				return $champArray[$i];
			}
		}
	}
	
	function getSkinIds() {
		$skinArray = getSkinArray();
		$ids = array();
		for ($i = 0; $i < count($skinArray); $i++) {
			array_push($ids, $skinArray[$i][0]);
		}
		return $ids;
	}
	
	function getSkinByName($skin) {
		$skinArray = getSkinArray();
		for ($i = 0; $i < count($skinArray); $i++) {
			if (strcmp($skinArray[$i][1],$skin) === 0) {
				return $skinArray[$i];
			}
		}
	}
	
	function getSkinById($id) {
		$skinArray = getSkinArray();
		for ($i = 0; $i < count($skinArray); $i++) {
			if (strcmp($skinArray[$i][0],$id) === 0) {
				return $skinArray[$i];
			}
		}
	}
	
	function getSkinsByChampId($champ) {
		$skinArray = getSkinArray();
		$champSkins = array();
		
		for ($i = 0; $i < count($skinArray); $i++) {
			if (strcmp($skinArray[$i][2],$champ) === 0) {
				array_push($champSkins,$skinArray[$i]);
			}
		}
		return $champSkins;
	}
	
	function getChampIdBySkinName($skin) {
		$skinArray = getSkinArray();
		
		for ($i = 0; $i < count($skinArray); $i++) {
			if (strcmp($skinArray[$i][1], $skin) === 0) {
				return $skinArray[$i][2];
			}
		}
	}
	
	function getChampIdBySkinId($id) {
		$skinArray = getSkinArray();
		
		for ($i = 0; $i < count($skinArray); $i++) {
			if (strcmp($skinArray[$i][0], $id) === 0) {
				return $skinArray[$i][2];
			}
		}
	}
	
	function getSkinsByTier($tier) {
		$skinArray = getSkinArray();
		$tierSkins = array();
		
		for ($i = 0; $i < count($skinArray); $i++) {
			if (strcmp($skinArray[$i][4], $tier) === 0) {
				array_push($tierSkins,$skinArray[$i]);
			}
		}
		
		return $tierSkins;
	}
	

	
	function endc($array) { return end($array); }
	
?>