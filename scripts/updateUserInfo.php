<?php 
	require('connect.php');
	session_start();
	if(isset($_POST['username'])) $userName = $_POST['username'];
	else $userName = '';

	if(isset($_POST['password'])) $pass = $_POST['password'];
	else $pass = '';

	if(isset($_SESSION['userIdNum'])) $id = $_SESSION['userIdNum'];
	else $id = '';

	$updateUserInfoOne = "UPDATE Users SET username = '". $userName ."' WHERE id = '". $id . "'";
	$updateUserInfoTwo = "UPDATE Subs SET password = '" . $pass ."' WHERE id = (SELECT subscriptionId as id FROM UserSub WHERE userId = '" . $id ."')";

	$conn->query($updateUserInfoOne);
	$conn->query($updateUserInfoTwo);

?>