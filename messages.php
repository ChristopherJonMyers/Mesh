<?php
    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    $id = $_SESSION["id"];
    
    $sqlGetMessages = "SELECT * FROM messages WHERE sender_id = '$id' OR receiver_id = '$id' ORDER BY conversation_id, datetime DESC";
    $resultMessages = $conn->query($sqlGetMessages);

    $resultsMessages = array();
    while ($row = $resultMessages->fetch_assoc()) {
        $resultsMessages[] = $row;
    }

    $sqlGetConvos = "SELECT id, last_message_datetime FROM conversations WHERE (initial_id = '$id' OR second_id = '$id') ORDER BY last_message_datetime DESC";
    $resultConvos = $conn->query($sqlGetConvos);
    
    $resultsConvos = array();
    while ($row = $resultConvos->fetch_assoc()) {
        $resultsConvos[] = $row;
    }

    $conversations = array();
    for ($i = 0; $i < count($resultsConvos); $i++) {
        
        $convId = $resultsConvos[$i]['id'];
        $sqlGetId = "SELECT initial_id, second_id FROM conversations WHERE id = $convId";
        $getIdResult = $conn->query($sqlGetId);
        $rowId = $getIdResult->fetch_assoc();
        $conversationId = ($rowId['initial_id'] == $id ? $rowId['second_id'] : $rowId['initial_id']);

        $sqlGetUsername = "SELECT user_name FROM accounts WHERE id = $conversationId";
        $resultGetUsername = $conn->query($sqlGetUsername);
        $rowUsername = $resultGetUsername->fetch_assoc();
        $convUsername = $rowUsername['user_name'];
        
        
        $convoObj = array(
            'last_message' => $resultsConvos[$i]['last_message_datetime'],
            'username' => $convUsername,
                         );
        $strId = "0".(string)($resultsConvos[$i]['id']);
        $conversations[$strId] = $convoObj;
    }

    for ($j = 0; $j < count($resultsMessages); $j++) {
        $strId = "0".(string)($resultsMessages[$j]['conversation_id']);
        if (!isset($conversations[$strId]['first'])) {
            $messObj = array(
                'sender' => $resultsMessages[$j]['sender_id'] == $id,
                'content' => $resultsMessages[$j]['content'],
                'datetime' => $resultsMessages[$j]['datetime']
                            );
            $conversations[$strId]['first'] = $messObj;
        }
    }
    $_SESSION["last_check"] = date("Y-m-d H:i:s");    
    $convosEncoded = json_encode($conversations);
    echo $convosEncoded;
