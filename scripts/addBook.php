<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$isbn = $_POST['isbn'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$publisher = $_POST['publisher'];
	$genre = $_POST['genre'];
	$numPages = $_POST['numPages'];
	$pubDate = $_POST['pubDate'];
	$synopsis = $_POST['synopsis'];
	$stock = 50;
	$checkedOut = 0;

	require("connect.php");
	$query = $conn->prepare("select id from Authors where name = ?");
	$query->bindParam(1, $author);
	$query->execute();
	$authorID = $query->fetchColumn();

	$conn->beginTransaction();
	try {
		$query = $conn->prepare("INSERT INTO Books(`ISBN`,`genre`,`numberOfPages`,`pubDate`,`title`,`synopsis`,`copiesInStock`,`copiesCheckedOut`) values (?, ?, ?, ?, ?, ?, ?, ?)");
		$query->bindParam(1, $isbn);
		$query->bindParam(2, $genre);
		$query->bindParam(3, $numPages);
		$query->bindParam(4, $pubDate);
		$query->bindParam(5, $title);
		$query->bindParam(6, $synopsis);
		$query->bindParam(7, $stock);
		$query->bindParam(8, $checkedOut);
		$query->execute();

		$query = $conn->prepare("INSERT INTO WrittenBy(`authorID`,`ISBN`) VALUES(?, ?)");
		$query->bindParam(1, $authorID);
		$query->bindParam(2, $isbn);
		$query->execute();

		$query = $conn->prepare("INSERT INTO PublishedBy(`name`, `ISBN`) VALUES(?, ?)");
		$query->bindParam(1, $publisher);
		$query->bindParam(2, $isbn);
		$query->execute();

		$conn->commit();
		echo "Success!";
	}

	catch(exception $e) {
		echo "Error on insert: " . $e->getMessage();
		$conn->rollBack();
	}
?>