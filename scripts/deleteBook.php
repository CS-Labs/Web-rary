<?php
	require("connect.php");
	$isbn = $_POST['isbn'];

	$conn->beginTransaction();
	try {
		$query = $conn->prepare("DELETE FROM PublishedBy WHERE ISBN = ?");
		$query->bindParam(1, $isbn);
		$query->execute();

		$query = $conn->prepare("DELETE FROM WrittenBy WHERE ISBN = ?");
		$query->bindParam(1, $isbn);
		$query->execute();

		$query = $conn->prepare("DELETE FROM Books WHERE ISBN = ?");
		$query->bindParam(1, $isbn);
		$query->execute();

		$conn->commit();
		echo "Book Successfully Deleted";
	}
	catch(exception $e) {
		echo "Error on Delete: ".$e->getMessage();
		$conn->rollBack(); 
	}
?>