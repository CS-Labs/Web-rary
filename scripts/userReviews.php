 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Stupidest Project Ever</title>
</head>

<body>
<p>
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	echo "start transaction";

	require('connect.php');
	$reviews = array();
	$users = array();
	$query = $conn->prepare("select id from Reviews");
	$query->execute();
	while($row = $query->fetch()) {
		array_push($reviews, $row['id']);
	}

	$query = $conn->prepare("select id from Users");
	$query->execute();
	while($row = $query->fetch()) {
		array_push($users, $row['id']);
	}

	$numReviews = count($reviews);
	$numUsers = count($users);
	$query = $conn->prepare("insert into UserReview values(?, ?)");
	for($i = 1; $i <= 157030; $i++) {
		$query->bindParam(1, $users[mt_rand(0, 26031)]);
		$query->bindParam(2, $i);
		$query->execute();
	}

	echo "Query complete";

	
?>
</p>

</body>

</html> 


