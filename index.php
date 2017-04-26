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
		<div class="col-lg-8" id="main-panel"></div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		<form method="post" action="searchResults.php">
			<label for="search-select" style="margin-top:15px">Search By:</label> 
			<select name="search-select" id="search-select" class="form-control">
				<option value="title">Title</option>
				<option value="author">Author</option>
				<option value="isbn">ISBN</option>
			</select>
			<input type="text" class="form-control" name="search-box" id="search-box">
			<button type="submit" class="btn" id="search-button">Search</button>
		</form>
		</div>
	</body>

</html>