<?php
    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchStr = $_POST["obj"];

    $sql = "SELECT user_name FROM accounts WHERE user_name LIKE '%$searchStr%'";
    $result = $conn->query($sql);

    $matches = array();
    while($row = $result->fetch_assoc()) {
        $matches[] = $row['user_name'];
    }
    
    $matchesEncoded = json_encode($matches);
    echo $matchesEncoded;