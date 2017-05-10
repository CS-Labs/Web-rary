<?php 
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	require("connect.php"); 
	if(isset($_POST['userName'])) $user = $_POST['userName'];
	else $user = '';
	session_start();
	$_SESSION['username'] = $user;
	if(isset($_POST['pass'])) $pass = $_POST['pass'];
	else $pass = '';
	if($user != '') {
		$userNameCheck = "SELECT id FROM Users WHERE userName = '" . $user . "';";

		$results = array();

		$result = $conn->query($userNameCheck);

		if ($result->rowCount() == 0) { 
			$userNameResult = "";
		} else { 
			$userNameResult = $result->fetchColumn();
		}

	 	array_push($results, $userNameResult);

		$passCheck = "SELECT password FROM (SELECT id as userId FROM Users WHERE userName = '" . $user . "') as a1 NATURAL JOIN UserSub, Subs WHERE password = '" . $pass . "' AND subscriptionId = id;";

		$result = $conn->query($passCheck);

		if ($result->rowCount() == 0) { 
			$passResult = "";
		} else { 
			$passResult = $result->fetchColumn();
		}

		// if($passResult != "" && $userNameResult != "")
		// {
		// 	$_SESSION['loggedIn'] = 1;
		// }

		array_push($results, $passResult);

		echo json_encode($results);
	}



?>