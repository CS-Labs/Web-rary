<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	session_start();
	require('scripts/connect.php');
	// require('scripts/authenticate.php');
	if(isset($_GET['isbn'])) $isbn = $_GET['isbn'];
	else $isbn = '';

	$query = $conn->prepare("select Books.ISBN, title, genre, numberOfPages, pubDate, synopsis, copiesInStock, Authors.name as author, PublishedBy.name as publisher from Books join PublishedBy on Books.ISBN = PublishedBy.ISBN join (Authors join WrittenBy on Authors.id = WrittenBy.authorID) on Books.ISBN = WrittenBy.ISBN where Books.ISBN = ?");
	$query->bindParam(1, $isbn);
	$query->execute();
	$book = $query->fetch();

	$reviews = array();
	$query = $conn->prepare("select contents, datePosted, username from Reviews join BookReviews on BookReviews.reviewID = Reviews.id and BookReviews.ISBN = ? natural join UserReview join Users on UserReview.userID = Users.id order by datePosted desc");
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
			<li><a data-toggle="modal" data-target="#mySignUpModal" href="#">Sign-Up</a></li>
			<li><a data-toggle="modal" data-target="#myLoginModal" href="#">Login</a></li>
		</ul>
	</div>
	
		<div class="jumbotron" id="header">
			<h1 id="title">Web-rary<span style="display:inline-block;">Like a regular library, but online...and not free</span></h1>
		</div>
		<div class="col-lg-2 sidebar" id="left-sidebar"></div>
		<div class="col-lg-8" id="main-panel">
  <div class="row book-info">
	  <div class="col-sm-4"><h4 class="inline-headers">Title: </h4><?php echo $book['title']; ?> </div>
	  <div class="col-sm-4"><h4 class="inline-headers">Author: </h4><?php echo $book['author']; ?> </div>
	  <div class="col-sm-4"><h4 class="inline-headers">Publisher: </h4><?php echo $book['publisher']; ?> </div>
	  
	  <div class="col-sm-4"><h4 class="inline-headers">Genre: </h4><?php echo $book['genre']; ?> </div>
	  <div class="col-sm-4"><h4 class="inline-headers">Date of Publication: </h4><?php echo $book['pubDate']; ?> </div>
	  <div class="col-sm-4"><h4 class="inline-headers">ISBN: </h4><?php echo $isbn; ?> </div>
	  
	  <div class="col-sm-12 text-center" id = "emptyRow" "></div>
	  <div class="col-sm-12 text-center"><h4 class="inline-headers">Synopsis:</h4>
	  <?php echo $book['synopsis']; ?>
  </div>
  </div>
        <div class="row">
          <div class="col-sm-12 text-center book-info" id = "emptyRow" "></div>
   
  <div class="col-lg-12" style="text-align:center">       
  	<button id="rent-button" class="btn btn-primary">Rent Book</button>
  </div>
    <div class="col-sm-4"> </div>
  <div class="col-lg-12">
	  <div class="col-lg-2"></div>

	  <div class="col-lg-8" style="text-align:center">
	  	<h2>Reviews For This Book</h2>
	  	<div class="form-group">
		  <label for="user-review">Write Your Own Review:</label>
		  <textarea class="form-control" rows="10" id="user-review"></textarea>
		  <button class="btn btn-primary" id="review-submit">Submit</button>
		</div>
		<div id="reviews-container" class="col-lg-12">
	  	<?php
	  		for($i = 0; $i < count($reviews); $i++) {
	  			echo "<div class='col-lg-6 review-text left'><h4 class='inline-headers'>User: </h4>".$reviews[$i]['username']."</div>";
	  			echo "<div class='col-lg-6 review-text right'><h4 class='inline-headers'>Date Posted: </h4>".$reviews[$i]['datePosted']."</div>";
	  			echo "<div class='col-lg-12'>".$reviews[$i]['contents']."</div>";
	  			echo "<div class='col-lg-12 review-spacer'></div>";
	  		}
	  	?>
	  	</div>
	  </div>
	</div>

  </div>

    </div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		</div>
	</div>
	</body>
	<script>
		var isbn = '<?php echo $isbn; ?>';
		$('#rent-button').click(function() {
			console.log(isbn);
		});
		$('#review-submit').click(function() {
			var contents = $('#user-review').val();			
			var today = new Date();
			var year = today.getFullYear();
			//the weird looking code with slice below adds 0 before number if it's single digit
			var day = ('0' + today.getDate()).slice(-2);
			var month = ('0' + (today.getMonth()+1)).slice(-2);
			today = year + '-' + month + '-' + day;
			$.ajax({
				type: 'post',
				url: 'scripts/addReview.php',
				data: {'isbn': isbn, 'contents': contents},
				success: function(data) {
					console.log(data);
					$('#user-review').val('');
					$('#reviews-container').prepend('<div class="col-lg-6 review-text left"><h4 class="inline-headers">User: </h4><?php echo $_SESSION['username']; ?></div><div class="col-lg-6 review-text right"><h4 class="inline-headers">Date Posted: </h4>'+today+'</div><div class="col-lg-12">'+contents+'</div><div class="col-lg-12 review-spacer"></div>');
				}
			})
		});
	</script>
</html>