<?php 
	require("scripts/connect.php");
	if(isset($_GET['search-box'])) $searchString = $_GET['search-box'];
	if(isset($_GET['search-select'])) $searchSelect = $_GET['search-select'];
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
				require("scripts/connect.php"); 
				if($searchSelect == 'author') {
					$searchQuery = "SELECT title, name, isbn FROM (SELECT title, Books.ISBN as isbn, authorID as id FROM Books, WrittenBy WHERE Books.ISBN = WrittenBy.ISBN) as a1 NATURAL JOIN Authors WHERE name LIKE '%" . $searchString . "%'";
				} else if($searchSelect == 'title') {
					$searchQuery = "SELECT title, name, isbn FROM (SELECT title, Books.ISBN as isbn, authorID as id FROM Books, WrittenBy WHERE Books.ISBN = WrittenBy.ISBN) as a1 NATURAL JOIN Authors WHERE title LIKE '%" . $searchString . "%'";
				} else if($searchSelect == 'author') {
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

	</body>

</html>

<script type='text/javascript'>
	<?php 
		echo "var jsResults = ".json_encode($phpResults).";\n";
	?>
	$('.pagination').attr('total-items', jsResults.length);
	for(var i = 0; i < jsResults.length; i++) {
		if(i < 100) {
			$('#results tbody').append('<tr><td><a isbn='+jsResults[i].isbn+' href=#>'+jsResults[i].title+'</a></td><td><a href="searchResults.php?search-select=author&search-box='+jsResults[i].name+'">'+jsResults[i].name+'</a></td></tr>');
		}
		
		if(i % 100 == 0) {
			$('.pagination-sm').append('<li><a value='+ (i / 100) +' href="#">'+ (i / 100 + 1) +'</a></li>');
		}
	}
	$(document).on('click', '.pagination>li>a', function() {
		var start = $(this).attr('value') * 100;
		$('#results tbody').empty();
		for(var i = start; i < (start + 100) && i < jsResults.length; i++) {
			$('#results tbody').append('<tr><td>'+jsResults[i].title+'</td><td><a href="searchResults.php?search-select=author&search-box='+jsResults[i].name+'">'+jsResults[i].name+'</a></td></tr>');
		}
	})

</script>