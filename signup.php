<html>
    <head>
        <title>Mesh</title>
        <!-- This page should have an input form where users can
             input their first name, last name, username,
             and password twice. A submit button should also be included. -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="main.js"></script>
        <link rel="stylesheet" type="text/css" href="home.css">
    </head>
	
    <body>
	
	<nav class="navbar navbar-light" style="background-color:#D2D5D9">
	  <div class="navbar-brand">
		<img src="images/pawel-czerwinski-unsplash.png" width="50" height="35" class="d-inline-block align-top" alt="Mesh Logo">
		<label style="color:#5682c9;">Sign Up For Mesh</label>
	  </div>
	</nav>
	
	<br><br>
    <form method="post" action="store_user.php">
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-3">
			<input type="text" name="userFirst" id="userFirst" placeholder="First Name" class="form-control"><br>
		</div>
		<div class="col-sm-3">
			<input type="text" name="userLast" id="userLast" placeholder="Last Name" class="form-control">
		</div>
		<div class="col-sm-3">
		</div>
	</div><br>
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<input type="text" name="userID" id="username" placeholder="Username" class="form-control">
		</div>
		<div class="col-sm-3">
		</div>
	</div><br>
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<input type="password" name="password" id="pass" placeholder="Password" class="form-control">
		</div>
		<div class="col-sm-3">
		</div>
	</div><br>
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<input type="password" name="passwordCheck" id="passCheck" placeholder="Verify Password" class="form-control">
		</div>
		<div class="col-sm-3">
		</div>
	</div><br>
    </form>
	
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<button class="btn btn-secondary btn-lg btn-block" onclick="checkusername(document.getElementById('username').value)">Sign Up</button>
		</div>
		<div class="col-sm-3">
		</div>
	</div><br>
	
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<p class="error_msg" id="message"></p>
		</div>
		<div class="col-sm-3">
		</div>
	</div>
			
    </body>
</html>
