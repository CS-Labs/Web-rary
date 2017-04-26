<html>
	<head>
		<title>Webrary</title>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/books.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<script src="js/jquery-1.12.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/app.js"></script>
	</head>
	<body bgcolor=white>
	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-right">
			<li><a data-toggle="modal" data-target="#mySignUpModal"href="#">Sign-Up</a></li>
			<li><a data-toggle="modal" data-target="#myLoginModal" href="#">Login</a></li>
		</ul>
	</div>
	
		<div class="jumbotron" id="header">
			<h1 id="title">Web-rary<span style="display:inline-block;">Like a regular library, but online...and not free</span></h1>
		</div>
		<div class="col-lg-2 sidebar" id="left-sidebar"></div>
		<div class="col-lg-8" id="main-panel">
    <div class="row">
  <div class="col-sm-4 book-info" ><b>Title:</b> </div>
  <div class="col-sm-4 book-info" ><b>Author:</b> </div>
  <div class="col-sm-4 book-info" ><b>Publisher:</b> </div>
  </div>
      <div class="row">
  <div class="col-sm-4 book-info"  ><b>Genre:</b> </div>
  <div class="col-sm-4 book-info"  ><b>Date of Publication:</b> </div>
  <div class="col-sm-4 book-info"  ><b>ISBN:</b> </div>
  </div>
        <div class="row">
          <div class="col-sm-12 text-center book-info" id = "emptyRow" "></div>
  <div class="col-sm-12 text-center book-info"  ><b>Synopsis:</b> </div>
  </div>
  <button type="button" class="btn btn-primary">Rent</button>
    </div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		</div>
	</div>
	</body>
</html>