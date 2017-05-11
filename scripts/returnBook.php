<?php 
	require('connect.php');
	if(isset($_POST['rentId'])) $rentId = $_POST['rentId'];
	else $rentId = '';

	$returnBookUpdate = 'UPDATE Rent SET dateReturned = curDate() WHERE id = ' . $rentId .';';

	$conn->query($returnBookUpdate);

	$getReturnDate = 'SELECT dateReturned FROM Rent WHERE id = ' . $rentId .';';

	$dateReturned = $conn->query($getReturnDate);

	echo json_encode($dateReturned->fetchColumn());
?>