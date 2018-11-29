<?php
    $image = $_FILES["fileToUpload"];
    session_start();
    $id = $_SESSION["id"];

    $target_dir = "images/";
$target_file = $target_dir . basename($image["name"]);
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        echo "The file ". basename( $image["name"]). " has been uploaded.";
        $uploadOk = 1;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $servername = "pdb25.awardspace.net";
    $username = "2649938_messages";
    $password = "hershmyers18";
    $dbname = "2649938_messages";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($uploadOk == 1) {
        $imageName = $image["name"];
        $sql = "UPDATE accounts SET pic = '$imageName' WHERE id = $id";
        $result = $conn->query($sql);
    }

    