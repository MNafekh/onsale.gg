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
   
	$champName = "";
	$champPrice = 0;
	$skinName = "";
	$skinPrice = 0;
	
	$html = file_get_contents('http://www.reignofgaming.net/news/31502-context-on-recent-pbe-changes-june-sales-schedule');

    preg_match('/<table class="table table-bordered table-striped">([^`]+?)<\/table>/', $html, $matches);
    $table = strip_tags($matches[0]);
    
    $array = explode("\n", $table);
   
    for ($i = 6; $i < count($array); $i++) {
        if ($array[$i] != "\n") {
            $champName = $array[$i];
            $champPrice = $array[++$i];
            $skinName = $array[++$i];
            $skinPrice = $array[++$i];
            echo $champName . $champPrice;
            echo $skinName . $skinPrice;
            
            $champSql = "UPDATE champions SET sale_price=" . $champPrice . "WHERE champion_name=" . $champName;
            $skinSql = "UPDATE skins SET sale_price=" . $skinPrice . "WHERE skin_name=" . $skinName;
            
            if ($conn->query($champSql) === TRUE && $conn->query($skinSql) === TRUE) {
                echo "Records updated successfully";
            } else {
                echo "Error updating records: " . $conn->error;
            }
        }
    }

    $conn->close();
?>
