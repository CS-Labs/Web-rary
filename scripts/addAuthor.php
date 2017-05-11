<?php 
	$name = $_POST['author'];
	$gender = $_POST['gender'];

	require("connect.php");
	try {
		$query = $conn->prepare("INSERT INTO Authors(`name`,`gender`) VALUES(?,?)");
		$query->bindParam(1, $name);
		$query->bindParam(2, $gender);
		$query->execute();

		echo "Success!";
	}
	catch(exception $e) {
		echo "Error on Insert: " . $e->getMessage();
	}
?>