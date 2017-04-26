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
				require("scripts/connect.php"); 
				if($searchSelect == 'author') {
					echo "Searching by Author.";
				} else if($searchSelect == 'title') {
					echo "Searching by Title";
				} else {
					echo "Searching by ISBN";
					$searchQuery = "SELECT title, name FROM (SELECT title, authorID as id FROM Books, WrittenBy WHERE Books.ISBN = \"". $searchString . "\" AND Books.ISBN = WrittenBy.ISBN) as a1 NATURAL JOIN Authors;";
				}

				echo "<br> Searching for: " . $searchString;
 
    			$result = $conn->query($searchQuery);
	
    			$table = "<h2>Results</h2>
  					 <p>Click on a row to view more information about a book.</p> 
  					 <table class=\"table table-hover table-bordered\"> 
    				   <thead>
     				   <tr>
        	 		  <th>Title</th>
        	 		  <th>Author</th>
      		 	       </tr>
    				  </thead>
    				  </thead>
    				  <tbody>";


    			while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    			$table .=  "<tr>
    					<td>". $row["title"]  . "</td>". "<td>" . $row["name"] . "</td></tr>";
     			}

    			$table .= "</tbody></table>";

    			echo $table;

			?> 

			</p>

		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar">

		  </div>

	</body>

</html>