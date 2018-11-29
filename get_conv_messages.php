<?php
    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $convId = $_POST["obj"];
    $convId = (int)$convId;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    $id = $_SESSION["id"];
    
    $sqlGetMessages = "SELECT content, sender_id, datetime FROM messages WHERE (sender_id = '$id' OR receiver_id = '$id') AND conversation_id = $convId ORDER BY datetime DESC";
    $resultMessages = $conn->query($sqlGetMessages);

    $sqlGetId = "SELECT initial_id, second_id FROM conversations WHERE id = $convId";
    $getIdResult = $conn->query($sqlGetId);
    $rowId = $getIdResult->fetch_assoc();
    $conversationId = ($rowId['initial_id'] == $id ? $rowId['second_id'] : $rowId['initial_id']);

    $sqlGetUsername = "SELECT user_name, pic FROM accounts WHERE id = $conversationId";
    $resultGetUsername = $conn->query($sqlGetUsername);
    $rowUsername = $resultGetUsername->fetch_assoc();
    $convUsername = $rowUsername['user_name'];
    $convPic = $rowUsername['pic'];

    $resultsMessages = array($convUsername, $convPic);
    while ($row = $resultMessages->fetch_assoc()) {
        $messObj = array(
            'sender' => $row['sender_id'] == $id,
            'content' => $row['content'],
            'datetime' => $row['datetime']
                        );
        $resultsMessages[] = $messObj;
    }
    
        
    $msgsEncoded = json_encode($resultsMessages);
    echo $msgsEncoded;
