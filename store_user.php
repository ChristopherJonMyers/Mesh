<?php
    $userData = $_POST["object"];
    $userData = json_decode($userData);

    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlCheckUserExists = "SELECT COUNT(*) c FROM accounts WHERE user_name = '$userData->username'";
    $resultCheckUserExists = $conn->query($sqlCheckUserExists);
    $count = $resultCheckUserExists->fetch_assoc();
    if ($count['c'] > 0) {
        echo "User already exists.";
    }
    else {
        $salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
        $pwh = password_hash($userData->pass.$salt, PASSWORD_DEFAULT);
        
        $sqlMakeUser = "INSERT INTO accounts (first_name, last_name, user_name, salt, pw_hash) VALUES ('$userData->firstName', '$userData->lastName', '$userData->username', '$salt', '$pwh')";
        $resultMakeUser = $conn->query($sqlMakeUser);
        $sqlGetInfo = "SELECT id FROM accounts WHERE user_name = '$userData->username'";
        $resultInfo = $conn->query($sqlGetInfo);
        $rowInfo = $resultInfo->fetch_assoc();
        session_start();
        $_SESSION["user"] = $userData->username;
        $_SESSION["id"] = $rowInfo['id'];
        header('Location: home.php');
    }
    