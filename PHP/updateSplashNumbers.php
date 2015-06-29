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
    
    // Get size of champions table
    $result = $conn->query("SELECT count(*) as total from champions");
    $numChamps = array();
    $numChamps = $result->fetch_assoc();
    //echo $numChamps['total'];

    //Store skins in an array for each champion in order of release date then update the splash number field
    for ($i = 1; $i < $numChamps['total'] + 1; $i++) {
        $skinResult = $conn->query("SELECT * FROM skins where champion_id = " . $i . " order by released");
        $skins = array();
        for ($j = 0; $j < $skinResult->num_rows; $j++) {
            $row = $skinResult->fetch_assoc();    
            $skins[$j][0] = $row["skin_name"];
            $skins[$j][1] = $row["released"];
            //echo $skins[$j][0] . ":" . $skins[$j][1] . "\n\n";
            $splashSql = "update skins set splash_num = " . ($j + 1) . " where skin_name = \"" . $row["skin_name"] . "\"";
            echo $splashSql . "\n\n";
            if ($conn->query($splashSql) === TRUE) {
                echo "Records updated successfully";
            } else {
                echo "Error updating records: " . $conn->error;
            }
        }
    }
    
    $conn->close();
    
?>
