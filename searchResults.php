<?php 
	require("scripts/connect.php");
	if(isset($_POST['search-box'])) $searchString = $_POST['search-box'];
	if(isset($_POST['search-select'])) $searchSelect = $_POST['search-select'];
?>

<html>
	<head>
		<title>Webrary</title>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
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
			<p> 
			<?php 
				if($searchSelect == 'author') {
					echo "Searching by Author.";
				} else if($searchSelect == 'title') {
					echo "Searching by Title";
				} else {
					echo "Searching by ISBN";
				}

				echo "<br> Searching for: " . $searchString;

			?> 
			</p>
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		
	</body>

</html>