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

	$html = file_get_contents('http://leagueoflegends.wikia.com/wiki/List_of_champions');

    preg_match('/<table class="stdt sortable" .*?>([^`]+?)<\/table>/', $html, $matches);
    $table = strip_tags($matches[0]);
    
    //echo $table;
    
    $array = explode("\n", $table);
    $champData = array_slice($array, 15);
    
    $champName = "";
    $releaseDate = '';
    $priceIP = 0;
    $priceRP = 0;
   
    for ($i = 0; $i < count($champData); $i++) {
        if ($champData[$i] != "\n") {
            $champName = substr($champData[$i],6);
            $i += 7;
            $releaseDate = $champData[$i];
            $priceIP = $champData[++$i];
            $priceRP = $champData[++$i];
            $i += 2;
            echo $champName . " " . $releaseDate . " " . $priceIP . " " . $priceRP;
            
            $champSql = "INSERT INTO champions (champion_name, price_ip, price_rp, release_date) 
            VALUES (\"" . $champName . "\", " . $priceIP . ", " . $priceRP . ", '" . $releaseDate . "')";
         
            if ($conn->query($champSql) === TRUE) {
                echo "Records updated successfully";
            } else {
                echo "Error updating records: " . $conn->error;
            }
        }
    }

    $conn->close();
?>
