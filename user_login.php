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

    $sql = "SELECT id, first_name, last_name, salt, pw_hash FROM accounts WHERE user_name = '$formUsername'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if (count($row) > 0) {
        $correctPass = password_verify($formPw.$row['salt'], $row['pw_hash']);
        if ($correctPass) {
            session_start();
            $_SESSION["user"] = $formUsername;
            $_SESSION["id"] = $row['id'];
            $_SESSION["first"] = $row['first_name'];
            $_SESSION["last"] = $row['last_name'];
            header('Location: home.php');
        }
        else {
            header('Location: login.php');
        }
    }
    else {
        header('Location: login.php');
    }
    
