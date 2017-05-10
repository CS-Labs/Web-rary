<?php 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cardType = $_POST['cardType'];
	$name = $_POST['name'];
	$ccNumber = $_POST['ccNumber'];
	$exp = $_POST['exp'];
	$billing = $_POST['billing'];
	$shipping = $_POST['shipping'];

	require("connect.php");
	$conn->beginTransaction();
	try {
		$query = $conn->prepare("insert into Users values (?)");
		$query->bindParam(1, $username);
		$query->execute();

		$userID = $conn->lastInsertID();

		$query = $conn->prepare("insert into Subs values(?, curdate(), curdate() + interval 1 month, 'Active', ?)");
		$query->bindParam(1, $password);
		$query->bindParam(2, $shipping);
		$query->execute();

		$subID = $conn->lastInsertID();

		$query = $conn->prepare("insert into UserSub values(?, ?)");
		$query->bindParam(1, $userID);
		$query->bindParam(2, $subID);
		$query->execute();

		$query = $conn->prepare("insert into SubPayment values(?, ?)");
		$query->bindParam(1, $subID);
		$query->bindParam(2, $ccNumber);
		$query->execute();

		$query = $conn->prepare("insert into PaymentInfo values(?, ?, ?, ?, ?");
		$query->bindParam(1, $cardType);
		$query->bindParam(2, $ccNumber);
		$query->bindParam(3, $name);
		$query->bindParam(4, $billing);
		$query->bindParam(5, $exp);
		$query->execute();


	}
?>