<?php
	require('connect.php');
	session_start();
	if(isset($_POST['nameOnCard'])) $nameOnCard = $_POST['nameOnCard'];
	else $nameOnCard = '';

	if(isset($_POST['cardType'])) $cardType = $_POST['cardType'];
	else $cardType = '';

	if(isset($_POST['ccNumber'])) $ccNumber = $_POST['ccNumber'];
	else $ccNumber = '';

	if(isset($_POST['expDate'])) $expDate = $_POST['expDate'];
	else $expDate = '';

	if(isset($_POST['billingAddress'])) $billingAddress = $_POST['billingAddress'];
	else $billingAddress = '';

	if(isset($_SESSION['userIdNum'])) $id = $_SESSION['userIdNum'];
	else $id = '';

	$getOldCCNum = "SELECT ccNumber FROM ((SELECT subscriptionID as subscriptionId FROM Subs, UserSub WHERE Subs.id = subscriptionID and UserID = '" . $id . "') as a1 NATURAL JOIN SubPayment) NATURAL JOIN PaymentInfo limit 1;";

	$oldCCResult = $conn->query($getOldCCNum);

	$oldCCNum = $oldCCResult->fetchColumn();

	$updatePaymentOne = "UPDATE PaymentInfo SET nameOnCard = '".$nameOnCard."' WHERE ccNumber = '" . $oldCCNum."'";
	$updatePaymentTwo = "UPDATE PaymentInfo SET cardType = '".$cardType."' WHERE ccNumber = '" . $oldCCNum."'";
	$updatePaymentThree = "UPDATE PaymentInfo SET expDate = '".$expDate."' WHERE ccNumber = '" . $oldCCNum."'";
	$updatePaymentFour = "UPDATE PaymentInfo SET billingAddress = '".$billingAddress."' WHERE ccNumber = '" . $oldCCNum."'";
	$updatePaymentFifth = "UPDATE PaymentInfo SET ccNumber = '".$ccNumber."' WHERE ccNumber = '" . $oldCCNum."'";

	$updatePaymentSixth = "UPDATE SubPayment SET ccNumber = '".$ccNumber."' WHERE ccNumber = '" .$oldCCNum ."'";

	$conn->query($updatePaymentOne);
	$conn->query($updatePaymentTwo);
	$conn->query($updatePaymentThree);
	$conn->query($updatePaymentFour);
	$conn->query($updatePaymentFifth);
	$conn->query($updatePaymentSixth);

?>