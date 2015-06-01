<?php

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

	$html = file_get_contents('http://leagueoflegends.wikia.com/wiki/Champion_skin/Available_skins');

    preg_match('/<table class="stdt sortable" .*?>([^`]+?)<\/table>/', $html, $matches);
    $table = strip_tags($matches[0]);
    
    //echo $table;
    
    $array = explode("\n", $table);
    $skinData = array_slice($array, 9);
    $square = array();
    $space = $skinData[3];
    
    for ($i = 0; $i < count($skinData); $i++) {
        if (strcmp($skinData[$i], $space) !== 0) {
            array_push($square, trim($skinData[$i]));
            //echo $skinData[$i] . ":";
        }
    }
    
    $skinName = "";
    $releaseDate = '';
    $priceRP = 0;
    $tier = "";
    $champID = 0;
    
    //Store champion names and IDs in an array
    $champQuery = "SELECT champion_id, champion_name FROM champions";
    $champResult = $conn->query($champQuery);
    $champArray = array();
    for ($i=0;$i<$champResult->num_rows;$i++) {
        $row = $champResult->fetch_assoc();
        $champArray[$i][0] = $row["champion_id"];
        $champArray[$i][1] = $row["champion_name"];
        //echo $champArray[$i][0] . ":" . $champArray[$i][1] . "\n";
    }
    
    for ($i = 0; $i < count($square); $i++) {
        if ($square[$i] != "\n") {
            $skinName = $square[$i];
            $priceRP = $square[++$i];
            $releaseDate = $square[++$i];
            
            // Associate skin with it's corresponding champ ID
            foreach ($champArray as $champ) {
                if (strpos($skinName, $champ[1]) !== false) {
                    $champID = $champ[0];
                    //echo $skinName . ":" . $champ[1] . "\n";
                }
            }
            
            //echo $skinName . ":" . $releaseDate . ":" . $priceRP . ":";
            // Get skin tier from database based on price in RP
            $findTier = "SELECT tier FROM pricing WHERE cost=" . $priceRP;
            $result = $conn->query($findTier);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $tier = $row["tier"];
            }
            
            if (preg_match("/....-..-../", $square[$i+1]))
                $i++;
            echo $skinName . ":" . $champID . ":" . $tier . ":" . $releaseDate . "\n";
            
            $skinSql = "INSERT INTO skins (skin_name, champion_id, tier, released) 
            VALUES (\"" . $skinName . "\", " . $champID . ", \"" . $tier . "\", '" . $releaseDate . "')";
         
            if ($conn->query($skinSql) === TRUE) {
                echo "Records updated successfully";
            } else {
                echo "Error updating records: " . $conn->error;
            }
            
        }
    }

    $conn->close();
?>
