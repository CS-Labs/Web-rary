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
				<div class="col-lg-12 form-group">
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
					<div id="exp">
						<label for="month">Month:</label>
						<select name="month" id="month" class="exp-select">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<label for="year">Year:</label>
						<select name="year" id="year" class="exp-select">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
						</select>
					<label for="billing">Billing Address</label>
					<input type="text" class="form-control" name="billing" id="billing" placeHolder="Billing Address">
					<label for="shipping">Shipping Address</label>
					<input type="text" class="form-control" name="shipping" id="shipping" placeHolder="Billing Address">
					<button id="sign-up" style="float:right; margin-top:35px" class="btn btn-primary">Sign Up</button>
				</div>
			</div>
		</div>
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		
	</body>
	<script>
	$('#sign-up').click(function() {
		console.log("Signing Up");
		var username = $('#username').val();
		var pass = $('#pass').val();
		var cardType = $('#card-type').val();
		var name = $('#name-on-card').val();
		var ccNumber = $('#cc-number').val();
		var exp = $('#year').val() + '-' + $('#month').val() + '1';
		var billing = $('#billing').val();
		var shipping = $('#shipping').val();

		$.ajax({
			type: 'post',
			url: 'scripts/addUser.php',
			data: {'username': username, 'pass': pass, 'cardType': cardType, 'name': name, 'ccNumber': ccNumber, 'exp': exp, 'billing': billing, 'shipping': shipping},
			success: function(data) {
				console.log(data);
			}
		});
	});
	</script>
</html>