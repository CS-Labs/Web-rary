<?php 
	session_start();
	require("connect.php");
	if(isset($_POST['contents'])) $contents = $_POST['contents'];
	else $contents = '';
	if(isset($_POST['isbn'])) $isbn = $_POST['isbn'];
	else $isbn = '';
	$username = $_SESSION['username'];
	
	$query = $conn->prepare("select id from Users where username = ?");
	$query->bindParam(1, $username);
	$query->execute();
	$userID = $query->fetchColumn();
	
	$conn->beginTransaction();

	try{
		$query = $conn->prepare("insert into Reviews(contents, datePosted) values (?, curdate())");
		$query->bindParam(1, $contents);
		$query->execute();

		$reviewID = $conn->lastInsertId();

		$query = $conn->prepare("insert into UserReview values(?, ?)");
		$query->bindParam(1, $userID);
		$query->bindParam(2, $reviewID);
		$query->execute();

		$query = $conn->prepare("insert into BookReviews values(?,?)");
		$query->bindParam(1, $reviewID);
		$query->bindParam(2, $isbn);
		$query->execute();

		$conn->commit();
	}

	catch(exception $e) {
		echo "Error inserting review: " . $e->getMessage();
		$conn->rollBack();
	}
	

?>