<?php 
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

		$userStatus = "";

		if($passResult != "" && $userNameResult != "")
		{
			$getUserIdQuery = "SELECT id FROM (SELECT id as userId FROM Users WHERE username = '" . $user . "') as a1 NATURAL JOIN UserSub, Subs WHERE password = '" . $pass . "' AND subscriptionId = id;";

			$result = $conn->query($getUserIdQuery);

			$userId = $result->fetchColumn();

			$checkStatus = "SELECT status FROM UserSub, Subs WHERE UserSub.userId = ".$userId." AND UserSub.subscriptionId = Subs.id";

			$result = $conn->query($checkStatus);

			$userStatus = $result->fetchColumn();

			if($userStatus == 'Active')
			{
				$_SESSION['userIdNum'] = $userId;
			}

		}

		array_push($results, $passResult);
		array_push($results, $userStatus);

		echo json_encode($results);
	}



?>