<?php

    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $formUsername = $_POST["userID"];
    $formPw = $_POST["userPassword"];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT salt, pw_hash FROM accounts WHERE user_name = '$formUsername'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if (count($row) > 0) {
        $userPW = password_hash($formPw.$row['salt'], PASSWORD_DEFAULT);
        if ($userPw == $row['pw_hash']) {
            session_start();
            $_SESSION["user"] = $formUsername;
            echo "Welcome, $formUsername.";
        }
    }
    else {
        
    }
    