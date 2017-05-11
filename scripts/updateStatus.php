<?php
	require('connect.php');
	session_start();

	if(isset($_SESSION['userIdNum'])) $id = $_SESSION['userIdNum'];
	else $id = '';

	echo "id: " . $id;

	$updateStatus = "UPDATE Subs SET status = 'Inactive' WHERE id = '". $id . "'";

	$conn->query($updateStatus);

?>