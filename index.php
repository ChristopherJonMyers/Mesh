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
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>

<nav class="navbar navbar-light" style="background-color:#D2D5D9">
  <div class="navbar-brand">
    <img src="images/pawel-czerwinski-unsplash.png" width="50" height="35" class="d-inline-block align-top" alt="Mesh Logo">
    <label style="color:#5682c9;">Welcome to Mesh</label>
  </div>
</nav>

<br><br>
<div class="row">
	<div class="col-sm-3">
	</div>
	<div class="col-sm-6">
    <h5>
        Login to carry on the conversation.<br>
        Sign up to start chatting.
    </h5>
	</div>
	<div class="col-sm-3">
	</div>
</div>
<br>
<div class="row">
	<div class="col-sm-3">
	</div>
	<div class="col-sm-3 d-sm-block">
    <form method="get" action="login.php">
        <button type="submit" class="btn btn-secondary btn-lg btn-block">Log In</button>
    </form>
	</div>
	<div class="col-sm-3 d-sm-block">
    <form method="get" action="signup.php">
        <button type="submit" class="btn btn-secondary btn-lg btn-block">Sign Up</button>
    </form>
	</div>
	<div class="col-sm-3">
	</div>
</div>
</body>

</html>
