<?php 
require("scripts/connect.php");
if(isset($_GET['search-box'])) $searchString = $_GET['search-box'];
if(isset($_GET['search-select'])) $searchSelect = $_GET['search-select'];
?>

<html>
<head>
	<title>Webrary</title>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="stylesheet" type="text/css" href="css/accountInfo.css"/>
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
		<h2 align="center"> Payment Info </h2>
		<p>Name on Card: </p>
		<p>Card Type: </p>
		<p>Card Number: </p>
		<p>Expiration Date: </p>
		<p>Billing Address: </p>
		<p>Shipping Address: </p>
		<div class="col-md-12 text-center">
			<button type="button" class="col-sm-12 col-centered btn btn-primary">Edit Payment Info</button>
		</div>
		<div class="col-sm-12 text-center" id = "emptyRow" "></div>
		<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />	
		<h2 align="center"> Account Info </h2>
		<p>Username: </p>
		<p>Password: </p>
		<div class="col-md-12 text-center">
			<button type="button" class="col-sm-12 col-centered btn btn-primary">Edit Account Info</button>
		</div>
		<div class="col-sm-12 text-center" id = "emptyRow" "></div>
		<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />	
		<h2 align="center"> Subscription Info </h2>
		<p>Subscription Status:
			<p>Start Date: </p>
			<p>Expiration Date: </p>
			<div class="col-sm-12 text-center" id = "emptyRow" "></div>
			<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />	
			<h2 align="center"> Rental History </h2>
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar"></div>


		<!-- Either have popup to edit the information or have edit box next to it? !-->

	</body>

	</html>