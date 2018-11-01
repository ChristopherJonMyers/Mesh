<?php 
        session_start();
        if (!(isset($_SESSION["testVar"]))) {
            $_SESSION["testVar"] = time();
            $_SESSION["id"] = uniqid("11", TRUE);
            $_SESSION["username"] = "mtwt1122";
        }
        $expire = 300;
        echo time();
        echo "\n";
        echo $_SESSION["testVar"];
        if (time() - $_SESSION["testVar"] > $expire) {
            echo " - ";
            session_unset();
            session_destroy();
            echo "\n"."Please refresh the page to log back in.";
        }

        $servername = "pdb25.awardspace.net";
        $username = "2649938_messages";
        $password = "hershmyers18";
        $dbname = "2649938_messages";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        
        $sql = "SELECT first_name, last_name FROM accounts WHERE user_name = '".$_SESSION["username"]."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
echo "\n";
        echo $row['first_name'] . " " . $row['last_name'];
    ?>
<html>
    
    <head>
    </head>
    
    <body>
        <p>Your session id is: <?php echo $_SESSION["id"]; ?></p>
        <a href="test2.php">Go</a>
    </body>
</html>