<?php 
	require("scripts/connect.php");
?>

<html>
	<head>
		<title>Webrary</title>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/signup.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<script src="js/jquery-1.12.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/app.js"></script>
	</head>
	<body bgcolor=white>
		<div class="jumbotron" id="header">
			<h1 id="title">Web-rary<span style="display:inline-block;">Like a regular library, but online...and not free</span></h1>
		</div>
		<div class="col-lg-2 sidebar" id="left-sidebar"></div>
		<div class="col-lg-8" id="main-panel">
			<div class="col-lg-1"></div>
			<div class="col-lg-6" id="sign-up-form" style="padding-top:20px">
				<h1>Enter Your Information</h1>
				<form>
					<label for="username">UserName:</label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Enter Your UserName">
					<label for="pass">Password:</label>
					<input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Your Password">
					<label for="card-type">Card Type</label>
					<select name="card-type" class="form-control" id="card-type">
						<option value="visa">Visa</option>
						<option value="mastercard">MasterCard</option>
						<option value="amex">American Express</option>
						<option value="discover">Discover</option>
					</select>
					<label for="name-on-card">Name on Card:</label>
					<input type="text" class="form-control" name="name-on-card" id="name-on-card" placeholder="Enter Cardholder Name">
					<label for="cc-number">Credit Card Number:</label>
					<input type="text" class="form-control" name="cc-number" id="cc-number" placeholder="Enter Card Number">
					<label for="exp">Expiration Date:</label>
					<input type="text" class="form-control" name="exp" id="exp" placeholder="Exp. Date">

				</form>
			</div>
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		
	</body>

</html>