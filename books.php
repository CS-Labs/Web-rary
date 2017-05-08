<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require('scripts/connect.php');
	if(isset($_GET['isbn'])) $isbn = $_GET['isbn'];
	else $isbn = '';

	$query = $conn->prepare("select Books.ISBN, title, genre, numberOfPages, pubDate, synopsis, copiesInStock, Authors.name as author, PublishedBy.name as publisher from Books join PublishedBy on Books.ISBN = PublishedBy.ISBN join (Authors join WrittenBy on Authors.id = WrittenBy.authorID) on Books.ISBN = WrittenBy.ISBN where Books.ISBN = ?");
	$query->bindParam(1, $isbn);
	$query->execute();
	$book = $query->fetch();

	$reviews = array();
	$query = $conn->prepare("select contents, datePosted, username from Reviews join BookReviews on BookReviews.reviewID = Reviews.id and BookReviews.ISBN = ? natural join UserReview join Users on UserReview.userID = Users.id");
	$query->bindParam(1, $isbn);
	$query->execute();
	$reviews = $query->fetchAll();
?>

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
  <div class="col-sm-4 book-info" ><b>Title: <?php echo $book['title']; ?></b> </div>
  <div class="col-sm-4 book-info" ><b>Author: <?php echo $book['author']; ?></b> </div>
  <div class="col-sm-4 book-info" ><b>Publisher: <?php echo $book['publisher']; ?></b> </div>
  </div>
      <div class="row">
  <div class="col-sm-4 book-info"  ><b>Genre: <?php echo $book['genre']; ?></b> </div>
  <div class="col-sm-4 book-info"  ><b>Date of Publication: <?php echo $book['pubDate']; ?></b> </div>
  <div class="col-sm-4 book-info"  ><b>ISBN: <?php echo $isbn; ?></b> </div>
  </div>
        <div class="row">
          <div class="col-sm-12 text-center book-info" id = "emptyRow" "></div>
  <div class="col-sm-12 text-center book-info"  ><b>Synopsis:</b> 
  <?php echo $book['synopsis']; ?>
  </div>
  </div>
        <div class="row">
          <div class="col-sm-12 text-center book-info" id = "emptyRow" "></div>
   <div class="col-sm-4 text-center"  ><b></b> </div>
         
  <button type="button" class="col-sm-4 col-centered btn btn-primary">Rent Book</button>
    <div class="col-sm-4"> </div>
  <div class="col-lg-12">
	  <div class="col-lg-2"></div>

	  <div class="col-lg-8" style="text-align:center">
	  	<h2>Reviews For This Book</h2>
	  	<?php
	  		for($i = 0; $i < count($reviews); $i++) {
	  			echo "<div><h4>Date Posted: </h4>".$reviews[$i]['datePosted']."</div>";
	  			echo "<div class='col-lg-12'>".$reviews[$i]['contents']."</div>";
	  		}
	  	?>
	  </div>
	</div>

  </div>

    </div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		</div>
	</div>
	</body>
</html>