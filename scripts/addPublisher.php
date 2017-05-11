<?php
	$name = $_POST['pubName'];
	$address = $_POST['address'];
	require("connect.php");

	try {
		$query = $conn->prepare("insert into Publisher values(?,?)");
		$query->bindParam(1, $name);
		$query->bindParam(2, $address);
		$query->execute();
		echo "Success!";

	}
	catch(exception $e) {
		echo "Error on Insert: " . $e->getMessage();
	}
?>