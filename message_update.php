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
    date_default_timezone_set('America/Indianapolis');
    $id = $_SESSION["id"];
    $last_check = $_SESSION["last_check"];

    $sql = "SELECT conversation_id, sender_id, content, datetime FROM messages WHERE (receiver_id = $id) AND datetime >= '$last_check'";
    $result = $conn->query($sql);
    if ($result != false) {
        $newMessages = array();
        while ($row = $result->fetch_assoc()) {
            $sentByUser = $id == $row["sender_id"];
            $content = $row["content"];
            $datetime = $row["datetime"];
            $temp = array("sender" => $sentByUser,
                        "content" => $content,
                        "datetime" => $datetime,
                          "lastcheck" => $last_check
                        );
            $conversationId = $row["conversation_id"];
            $newMessages[] = array($conversationId, $temp);
        }
        $newMessagesEncoded = json_encode($newMessages);
        echo $newMessagesEncoded;
    }
    else {
        echo json_encode(array());
    }
    $_SESSION["last_check"] = date("Y-m-d H:i:s");
    