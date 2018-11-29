<?php
    $msgData = $_POST["object"];
    $msgData = json_decode($msgData);
    $recipient = $msgData->recipient;
    $content = $msgData->content;
    session_start();
    $id = $_SESSION["id"];
    date_default_timezone_set('America/Indianapolis');
    $datetime = date("Y-m-d H:i:s");

    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlGetRecipient = "SELECT id FROM accounts WHERE user_name = '$recipient'";
    $resultGetRecipient = $conn->query($sqlGetRecipient);
    $row = $resultGetRecipient->fetch_assoc();
    $recipient = $row['id'];

    $sqlGetConvo = "SELECT id FROM conversations WHERE (initial_id = '$id' AND second_id = '$recipient') OR (initial_id = '$recipient' AND second_id = '$id')";
    $resultConvo = $conn->query($sqlGetConvo);
    $convoId = 0;
    if (mysqli_num_rows($resultConvo) > 0) {
        $rowConvo = $resultConvo->fetch_assoc();
        $convoId = $rowConvo['id'];
        $updateConvoSql = "UPDATE conversations SET last_message_datetime = '$datetime' WHERE id = $convoId";
        $updateConvoResult = $conn->query($updateConvoSql);
    }
    else if ($recipient != 0) {
        $sqlNewConvo = "INSERT INTO conversations (initial_id, second_id, last_message_datetime) VALUES ('$id', '$recipient', '$datetime')";
        $resultNewConvo = $conn->query($sqlNewConvo);
        $resultGetNewConvo = $conn->query($sqlGetConvo);
        $rowConvo = $resultGetNewConvo->fetch_assoc();
        $convoId = $rowConvo['id'];
    }
    
    if ($recipient != $id) {
        $sqlMessage = "INSERT INTO messages (conversation_id, sender_id, receiver_id, content, datetime) VALUES ('$convoId', '$id', '$recipient', '$content', '$datetime')";
        $resultMessage = $conn->query($sqlMessage);
        echo $datetime;
    }
    

    
    
