<?php 
	require("scripts/connect.php");
	if(isset($_GET['search-box'])) $searchString = $_GET['search-box'];
	if(isset($_GET['search-select'])) $searchSelect = $_GET['search-select'];
?>

<?php include("shared/pageStart.html"); ?>

			<?php
				require("scripts/connect.php"); 
				if($searchSelect == 'author') {
					$searchQuery = "SELECT title, name, isbn FROM (SELECT title, Books.ISBN as isbn, authorID as id FROM Books, WrittenBy WHERE Books.ISBN = WrittenBy.ISBN) as a1 NATURAL JOIN Authors WHERE name LIKE '%" . $searchString . "%'";
				} else if($searchSelect == 'title') {
					$searchQuery = "SELECT title, name, isbn FROM (SELECT title, Books.ISBN as isbn, authorID as id FROM Books, WrittenBy WHERE Books.ISBN = WrittenBy.ISBN) as a1 NATURAL JOIN Authors WHERE title LIKE '%" . $searchString . "%'";
				} else if($searchSelect == 'isbn') {
					$searchQuery = "SELECT title, name, isbn FROM (SELECT title, Books.ISBN as isbn, authorID as id FROM Books, WrittenBy WHERE Books.ISBN = \"". $searchString . "\" AND Books.ISBN = WrittenBy.ISBN) as a1 NATURAL JOIN Authors;";
				} else {
					$searchQuery = "select title, name, isbn from (select title, Books.ISBN as isbn, authorID as id from Books, WrittenBy where genre = '".$searchString."' and Books.ISBN = WrittenBy.ISBN) as a1 natural join Authors";
				}
 
    			$result = $conn->query($searchQuery);
    			$phpResults = array();
    			while($row = $result->fetch()) {
    				array_push($phpResults, $row);
     			}
			?> 
			<h2>Results</h2>
			<div class="col-lg-6"> 
				<p>Click on a row to view more information about a book.</p>
			</div>
			<div class="col-lg-6" style="text-align: right">
				<ul class="pagination pagination-sm">
				</ul>
			</div>
			<table class="table table-hover table-bordered" id="results">
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar">

		  </div>

<?php include("shared/modalsComm.html"); ?>


	</body>

</html>

<script type='text/javascript'>
	<?php 
		echo "var jsResults = ".json_encode($phpResults).";\n";
	?>
	$('.pagination').attr('total-items', jsResults.length);
	for(var i = 0; i < jsResults.length; i++) {
		if(i < 100) {
			$('#results tbody').append('<tr><td><a href=books.php?isbn='+jsResults[i].isbn+'>'+jsResults[i].title+'</a></td><td><a href="searchResults.php?search-select=author&search-box='+jsResults[i].name+'">'+jsResults[i].name+'</a></td></tr>');
		}
		
		if(i % 100 == 0) {
			$('.pagination-sm').append('<li><a value='+ (i / 100) +' href="#">'+ (i / 100 + 1) +'</a></li>');
		}
	}
	$(document).on('click', '.pagination>li>a', function() {
		var start = $(this).attr('value') * 100;
		$('#results tbody').empty();
		for(var i = start; i < (start + 100) && i < jsResults.length; i++) {
			$('#results tbody').append('<tr><td><a href=books.php?isbn='+jsResults[i].title.isbn+'>'+jsResults[i].title+'</td><td><a href="searchResults.php?search-select=author&search-box='+jsResults[i].name+'">'+jsResults[i].name+'</a></td></tr>');
		}
	})

	
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