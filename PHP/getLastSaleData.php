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

    //Store champion names and IDs in an array
    $champQuery = "SELECT champion_id, champion_name, DATE_FORMAT(release_date, '%m-%d-%Y') FROM champions";
    $champResult = $conn->query($champQuery);
    $champArray = array();
    for ($i=0;$i<$champResult->num_rows;$i++) {
        $row = $champResult->fetch_assoc();
        $champArray[$i][0] = $row["champion_id"];
        $champArray[$i][1] = trim($row["champion_name"]);
        $champArray[$i][2] = $row["DATE_FORMAT(release_date, '%m-%d-%Y')"];
        //echo $champArray[$i][0] . ":" . $champArray[$i][1] . "\n";
    }

    foreach ($champArray as $champ) {
        // lolking.net urls don't have apostrophes, spaces, or weird characters. Wukong is listed as monkeyking for some reason
        if ($champ[0] != 115)
            $champUrl = str_replace(array('.',' ','\''), '', $champ[1]);
        else
            $champUrl = 'monkeyking';
        $champId = $champ[0];
        $html = file_get_contents('http://www.lolking.net/champions/' . $champUrl . '#store');
        preg_match('/<div class="champion-skins medium">([^`]+?)<\/div> <!-- end tabs wrapper -->/', $html, $matches);
        $table = str_replace("Released:","\nReleased:",strip_tags($matches[0]));
   
        /*test
        $html = file_get_contents('http://www.lolking.net/champions/drmundo#store');
        preg_match('/<div class="champion-skins medium">([^`]+)<\/div> <!-- end tabs wrapper -->/', $html, $matches);
        $table = str_replace("Released","\nReleased",strip_tags($matches[0]));
        //echo $table;
        */
        $champData = explode("\n", trim($table));
        $spaceless = array();
        $space = trim($champData[3]);
    
        for ($i = 0; $i < count($champData); $i++) {
            if (strcmp(trim($champData[$i]),$space) !== 0) {
                array_push($spaceless, trim($champData[$i]));
            }
        }
        
        for ($i=0;$i<count($spaceless);$i++) {
            //echo $spaceless[$i] . "|";
            if (strpos($spaceless[$i],"Released") !== false) {
                //echo "\n";
            }
        }
        echo "\n";
        
        // Store champion's skins in an array
        $skinQuery = "SELECT skin_id, skin_name, champion_id, DATE_FORMAT(released, '%m-%d-%Y') FROM skins 
            WHERE champion_id = " . $champId;
        $skinResult = $conn->query($skinQuery);
        $skinArray = array();
        for ($i=0;$i<$skinResult->num_rows;$i++) {
            $row = $skinResult->fetch_assoc();
            $skinArray[$i][0] = $row["skin_id"];
            $skinArray[$i][1] = $row["skin_name"];
            $skinArray[$i][2] = $row["champion_id"];
            $skinArray[$i][3] = str_replace("-", "/", $row["DATE_FORMAT(released, '%m-%d-%Y')"]);
            //echo $skinArray[$i][0] . ":" . $skinArray[$i][1] . ":" . $skinArray[$i][2] . ":" . 
            //    $skinArray[$i][3] . "\n";
        }
        
        // Check if champion has been on sale before
        if (strpos($spaceless[3],"Last Sale") !== false) {
            $champLastSale = substr($spaceless[3],-10);
            $champReleaseDate = substr($spaceless[4],-10);
            $firstSkinPos = 5;
        } else if (strpos($spaceless[3], "On Sale") !== false) {
            $champLastSale = "06/22/2015";
            $champReleaseDate = substr($spaceless[4],-10);
            $firstSkinPos = 5;
        } else {
            $champLastSale = "00/00/0000";
            $champReleaseDate = substr($spaceless[3],-10);
            $firstSkinPos = 4;
        }
        
        // Get last time champ was on sale and update champions table
        $champDateSQL = "UPDATE champions SET release_date = STR_TO_DATE('" . $champReleaseDate . "', 
            '%m/%d/%Y'),last_on_sale=STR_TO_DATE('" . $champLastSale . "','%m/%d/%Y') WHERE champion_id=" . $champId;
        //echo $champDateSQL . "\n";
        /*
        if ($conn->query($champDateSQL) === TRUE) {
            echo "Records updated successfully";
        } else {
            echo "Error updating records: " . $conn->error;
        }
               
        /*
            Emumu, Fiddle Me Timbers, Crabgot, Samurai Yi 
            Corporate Mundo, Rageborn Mundo
            Viridian Kayle
            Vindicator Vayne
            Superb Villain Veigar
            
            Lunar Revel Diana - Lunar Goddess
            Sultan Gangplank - Sultan Gankplank
            Dragon Slayer Jarvan IV - Dragonslayer Jarvan IV
            Fnatic J4 - Fnatic Jarvan
            Bloodmoon Kalista - Blood Moon Kalista
            Judgement Kayle - Judgment Kayle
            Arclight Velkoz - Justicar Velkoz
            Desperado Yasuo - High Noon Yasuo
            Project: Yasuo - Project Yasuo
            Bladestorm Zed - Shockblade Zed
            
        */
        
        // Get release and last sale date of champion's skins
        $skinName = "";
        $skinReleaseDate = '';
        $skinLastSale = '';
        
        for ($i = $firstSkinPos; $i < count($spaceless); $i++) {
            if ($spaceless[$i] != "\n") {
                $skinName = $spaceless[$i];
                $i+=3;
                if (strpos($spaceless[$i],"Last Sale") !== false) {
                    $skinLastSale = substr($spaceless[$i],-10);
                    $i++;
                } else if (strpos($spaceless[$i], "On Sale") !== false) {
                    $skinLastSale = '06/22/2015';
                    $i++;
                } else
                    $skinLastSale = '00/00/0000';
                    
                if (strpos($spaceless[$i], "Not Yet") === false)
                    $skinReleaseDate = substr($spaceless[$i],-10);
                else
                    $skinReleaseDate = '';
                
                $skinFound = false;
                for ($j=0; $j < count($skinArray); $j++) {
                    if (stripos($skinArray[$j][1], $skinName) !== false) {
                        $skinFound = true;
                        if (strcmp($skinReleaseDate, '') === 0 || strcmp($skinName,'Elderwood Bard') === 0) {
                            $skinReleaseDate = $skinArray[$j][3];
                        }
                    }
                }
                if ($skinFound === false) {
                    //echo $skinName . " not found in db, ";
                    if (strcmp($skinLastSale,'00/00/0000') !== 0) {
                        //echo "last sold " . $skinLastSale;
                    }
                    //echo "and released " . $skinReleaseDate . "\n\n ";
                } else {
                    //echo $skinName . ": Last Sold " . $skinLastSale . "\n\n";
                    $skinSql = "UPDATE skins SET last_on_sale=STR_TO_DATE('" . $skinLastSale . "','%m/%d/%Y') WHERE skin_name=\"" . $skinName . "\"";
                    echo $skinSql . "\n";
                 	/*
                    if ($conn->query($skinSql) === TRUE) {
                        echo "Records updated successfully";
                    } else {
                        echo "Error updating records: " . $conn->error;
                    }
					*/
                }
            }
        }
    }
    $conn->close();
    
?>
