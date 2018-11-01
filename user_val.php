<?php
    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $userID = $_POST['object'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT(*) c FROM accounts WHERE user_name = '$userID';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $count = $row['c'];
    $userExists = $count > 0;
    $userExists = json_encode($userExists);
    echo $userExists;
    