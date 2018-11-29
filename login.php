<?php

    session_start();
    if ($_SESSION["id"]) {
        header('Location: home.php');
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
        <script type="text/javascript" src="main.js"></script>
        <link rel="stylesheet" type="text/css" href="home.css">
    </head>
    <body style="background-image:url('Background.png'); background-size:cover; background-repeat:no-repeat; background-attachment: fixed; width:98%; margin:auto;">
		<nav class="navbar navbar-light" style="background-color:#D2D5D9">
		  <div class="navbar-brand">
			<img src="images/pawel-czerwinski-unsplash.png" width="50" height="35" class="d-inline-block align-top" alt="Mesh Logo">
			<label style="color:#5682c9;">Mesh</label>
		  </div>
		</nav>
        <form method="POST" action="user_login.php" >
		<br><br>
		
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-3">
				<input type="text" name="userID" placeholder="Username" class="form-control"><br>
			</div>
			<div class="col-sm-3">
				<input type="password" name="userPassword" placeholder="Password" class="form-control">
			</div>
			<div class="col-sm-3"></div>
		</div><br>
		
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<input type="submit" value="Log In" class="btn btn-secondary btn-lg btn-block">
			</div>
			<div class="col-sm-3"></div>
		</div>
        </form>
    </body>
</html>
    
