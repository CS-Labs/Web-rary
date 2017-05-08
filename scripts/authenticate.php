<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require("connect.php"); 
	if(isset($_POST['userName'])) $userName = $_POST['userName'];
	else $userName = '';
	if(isset($_POST['pass'])) $pass = $_POST['pass'];
	else $pass = '';

	$userNameCheck = "SELECT id FROM Users WHERE userName = '" . $userName . "';";

	$results = array();

	$result = $conn->query($userNameCheck);

	if ($result->rowCount() == 0) { 
		$userNameResult = "";
	} else { 
		$userNameResult = $result->fetchColumn();
	}

 	array_push($results, $userNameResult);

	$passCheck = "SELECT password FROM (SELECT id as userId FROM Users WHERE userName = '" . $userName . "') as a1 NATURAL JOIN UserSub, Subs WHERE password = '" . $pass . "' AND subscriptionId = id;";

	$result = $conn->query($passCheck);

	if ($result->rowCount() == 0) { 
		$passResult = "";
	} else { 
		$passResult = $result->fetchColumn();
	}

	array_push($results, $passResult);

	echo json_encode($results);


?>