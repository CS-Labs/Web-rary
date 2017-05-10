<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	session_start();
	require('scripts/connect.php');
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

<?php include("shared/pageStart.html"); ?>

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
			<form method="get" action="searchResults.php">
		        <label for="search-select" style="margin-top:15px">Search By:</label> 
		        <select name="search-select" id="search-select" class="form-control">
		            <option value="title">Title</option>
		            <option value="author">Author</option>
		            <option value="isbn">ISBN</option>
		            <option value="genre">genre</option>
		        </select>
		        <input type="text" class="form-control" name="search-box" id="search-box">
		        <button type="submit" class="btn" id="search-button">Search</button>
    		</form>
		</div>
	</div>

	<?php include("shared/modalsComm.html"); ?>


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

	
  $(document).on('click', '#confirmLogOut', function(e) {
    $.ajax({
        type: 'post',
        url: 'scripts/setLoggedOut.php',
        data: {},

        success: function (data) {}

    })

    $('#LoginBtn a').text('Login');
    $('#LoginBtn a').attr('data-target','#myLoginModal');
    $('#accountInfoBtn').attr('style', 'display:none;');
});

  $(document).on('click', '#log-in', function(e) {
     $('#LoginBtn a').text('Login');
     e.preventDefault();
     $('#error-info').empty();
     var userName = $('#myUserName').val();
     var pass = $('#myPassword').val();
     $.ajax({
        type: 'post',
        url: 'scripts/authenticate.php',
        data: {'userName': userName, 'pass': pass},

        success: function(data) {
          var authData = JSON.parse(data);
          if(authData[0] == "")
          {
            $('#error-info').append("<font color='red'><b>INVALID USERNAME</b></font>");
        }
        else if (authData[1] == "")
        {
            $('#error-info').append("<font color='red'><b>INVALID PASSWORD</b></font>");
        }
        else
        {
            $.ajax({
                type: 'post',
                url: 'scripts/setLoggedIn.php',
                data: {},

                success: function (data) {}

            })

           $('#LoginBtn a').text('Logout');
           $('#LoginBtn a').attr('data-target','#logOutMessageModal');
           $('#myLoginModal').modal('hide');
           $('#accountInfoBtn').attr('style', '');
       }
   }

})
 });
	</script>
</html>