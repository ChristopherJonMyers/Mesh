<?php
    session_start();
    if ($_SESSION["id"]) {
        
    }
    else {
        header('Location: login.php');
    }
?>

<html>
    <head>
        <title>Mesh</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
        <script type="text/javascript" src="messages.js"></script> 
        <link rel="stylesheet" type="text/css" href="home.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>
	
    <body onload="retrieveMessages(); addListener(); document.getElementById('msgsBtn').click">
        <nav class="navbar navbar-light" style="background-color:#D2D5D9">
		  <div class="navbar-brand">
			<img src="images/pawel-czerwinski-unsplash.png" width="50" height="35" class="d-inline-block align-top" alt="Mesh Logo">
			<label class="d-inline-block" style="color:#5682c9;"><?php echo "Welcome, ".$_SESSION["user"]; ?></label><a href="image.php" style="text-decoration: none; color: white; font-size: 0.5em">Upload image</a>
			<button id="convsBtn" class="btn btn-secondary btn-md btn-inline" type="button" onclick="toggle(1)">
				Conversations
			</button>
              <button id="msgsBtn" class="btn btn-secondary btn-md btn-inline" type="button" onclick="toggle(2); getMessagesConvo(activeConversation);">
				Messages
			</button>
			<form action="logout.php" class="d-inline-block">
				<input type="submit" value="Log Out" class="btn btn-secondary btn-md btn-inline-block">
			</form>
		  </div>
		</nav>
		
        <div id="container">
		<div class="acollapse" id="collapseExample">
            <div id="convHolder">
                <div id="searchUser">
                        <input type="text" id="recipient" list="recipientMatches" placeholder="Search Users">
                        <datalist id="recipientMatches"></datalist>
                        <button onclick="startBlankConvo()" id="startConvo">New Message</button>
                </div>
                <div id="conversations"></div>
            </div>
			</div>
            <div class="acollapse" id="messagesHolder">
                <div id="convUser"></div>
                <div id="messages" class="scroll"></div>
                <div id="inputHolder">
                    <input type="text" id="convMsg">
                    <button onclick="prepareMessage()" id="msgBtn">Send</button>
                </div>
            </div>
        </div>
    </body>
</html>
