<?php
	session_start();
	$isbn = $_POST['isbn'];
	if(isset($_SESSION['userIdNum'])) $userID = $_SESSION['userIdNum'];
	else $userID = '';
	require("connect.php");

	if(!isset($_SESSION['userIdNum']) || $userID == '') {
		echo "You must log in before renting a book";
	} else {
		$query = $conn->prepare("select count(*) from Rent where userID = ?");
		$query->bindParam(1, $userID);
		$query->execute();
		$rentalCount = $query->fetchColumn();

		if($rentalCount < 5) {
			$query = $conn->prepare("insert into Rent(dateRented, ISBN, userID) values (curdate(), ?, ?)");
			$query->bindParam(1, $isbn);
			$query->bindParam(2, $userID);
			$query->execute();
			echo "Your order has been placed!";
		} else {
			echo "You have already have 5 books Rented. Return one to be able to rent another.";
		}
	}
	
?>