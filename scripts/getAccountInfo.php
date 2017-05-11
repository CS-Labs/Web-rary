<?php 

	if(isset($_SESSION['userIdNum']))
	{
		$id = $_SESSION['userIdNum'];

		$userNameQuery = "SELECT username FROM Users WHERE id = '" . $id . "';";

		$subInfoQuery = "SELECT * FROM Subs, UserSub WHERE Subs.id = subscriptionID AND UserID = '" . $id ."';";

		$paymentInfoQuery = "SELECT * FROM ((SELECT subscriptionID as subscriptionId FROM Subs, UserSub WHERE Subs.id = subscriptionID and UserID = '" . $id . "') as a1 NATURAL JOIN SubPayment) NATURAL JOIN PaymentInfo limit 1;";

		echo '<h2 align="center"> Payment Info </h2>';

		$paymentResult = $conn->query($paymentInfoQuery);
		$userResult = $conn->query($userNameQuery);
		$subResult = $conn->query($subInfoQuery);

		if ($paymentResult->rowCount() != 0)
		{
			$paymentInfoResult = $paymentResult->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			$paymentInfoResult = "";
		}
		if ($subResult->rowCount() != 0)
		{
			$subPaymentResult = $subResult->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			$subPaymentResult = "";
		}

		if ($userResult->rowCount() != 0)
		{
			$userNameResult = $userResult->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			$userNameResult = "";
		}


		if ($paymentInfoResult != "") 
		    { 
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<p>Name On Card: </p>';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<input class="form-control" id="nameOnCard" value="' .  $paymentInfoResult['nameOnCard'] . '">';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<p>Card Type: </p>';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<input class="form-control" id="cardType" value="' .  $paymentInfoResult['cardType'] . '">';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<p>Card Number: </p>';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<input class="form-control" id="ccNumber" value="' .  $paymentInfoResult['ccNumber'] . '">';
		    	echo '</div>';	
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<p>Expiration Date: </p>';
		    	echo '</div>';	
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<input class="form-control" id="expDate" value="' .  $paymentInfoResult['expDate'] . '">';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<p>Billing Address: </p>';
		    	echo '</div>';
		    	echo '<div class="col-md-6 text-center">';
		    	echo '<input class="form-control" id="billingAddress" value="' .  $paymentInfoResult['billingAddress'] . '">';
		    	echo '</div>';
			}


		echo '<div class="col-md-12 text-center">';
		echo '<button type="button" id = "updatePaymentInfoBtn" class="btn btn-primary">Update Payment Info</button>';
		echo '</div>';
		echo '<div class="col-sm-12 text-center" id = "emptyRow" "></div>';
		echo '<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />';
		echo '<h2 align="center"> Account Info </h2>';

		if($subPaymentResult != "" && $userNameResult != "")
		{
		    echo '<div class="col-md-6 text-center">';
		    echo '<p>Username: </p>';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<input class="form-control" id="username" value="' .  $userNameResult['username'] . '">';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<p>Password: </p>';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<input class="form-control" id="password" value="' .  $subPaymentResult['password'] . '">';
		    echo '</div>';			    		    			
		}

		echo '<div class="col-md-12 text-center">';
		echo '<button type="button" id = "updateAccountInfoBtn" class="btn btn-primary">Update Account Info</button>';
		echo '</div>';
		echo '<div class="col-sm-12 text-center" id = "emptyRow" "></div>';
		echo '<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />';
		echo '<h2 align="center"> Subscription Info </h2>';

		if($subPaymentResult != "")
		{	
		    echo '<div class="col-md-6 text-center">';
		    echo '<p>Subscription Status: </p>';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<p id = "statusCell">' .  $subPaymentResult['status'] . '</p>';
		    echo '</div>';		    echo '<div class="col-md-6 text-center">';
		    echo '<p>Start Date: </p>';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<p>' .  $subPaymentResult['startDate'] . '</p>';
		    echo '</div>';		    echo '<div class="col-md-6 text-center">';
		    echo '<p>Expiration Date: </p>';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<p>' .  $subPaymentResult['expDate'] . '</p>';
		    echo '</div>';		    echo '<div class="col-md-6 text-center">';
		    echo '<p>Shipping Address: </p>';
		    echo '</div>';
		    echo '<div class="col-md-6 text-center">';
		    echo '<p>' .  $subPaymentResult['shippingAddress'] . '</p>';
		    echo '</div>';			
		}

		echo '<div class="col-md-12 text-center">';
		echo '<button type="button" id = "cancelSubBtn" class="btn btn-danger">Cancel Subscription</button>';
		echo '</div>';
		echo '<div class="col-sm-12 text-center" id = "emptyRow" "></div>';
		echo '<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />';
		echo '<h2 align="center"> Rental History </h2>';



		$rentalHistoryQuery = "SELECT title, authorName, dateRented, dateReturned, rentId FROM (SELECT dateReturned, dateRented, ISBN, userID, userName, Users.id, Rent.id as rentId FROM Rent, Users WHERE Rent.userId = Users.id AND Users.id = '" .$id . "' ) as a1 NATURAL JOIN Books NATURAL JOIN (SELECT name as authorName, ISBN FROM Authors, WrittenBy WHERE authorID = Authors.id) as a2 ORDER BY dateRented DESC;";


		$rentalHistoryResult = $conn->query($rentalHistoryQuery);
		echo '<table class="table table-bordered">';
		echo '<thead>';
		echo '<tr>';
		echo '<th>Title</th>';
		echo '<th>Author</th>';
		echo '<th>Date Rented</th>';
		echo '<th>Date Returned</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';


		while($row = $rentalHistoryResult->fetch(PDO::FETCH_ASSOC)) {
      		echo '<tr>';
      		echo '<td>' . $row['title'] . '</td>';
      		echo '<td>' . $row['authorName'] . '</td>';
      		echo '<td>' . $row['dateRented'] . '</td>';
      		if (is_null($row['dateReturned']))
      		{
      			echo '<td id = "' . $row['rentId'] . '"><button type="button" rentId = "' .$row['rentId'] . '" class="btn btn-primary return-btn">Return Book</button></td>';
      		}
      		else
      		{
      			echo '<td>' . $row['dateReturned'] . '</td>';
      		}
      		echo '</tr>';
  		}

  		echo '</tbody>';
  		echo '</table>';
  		echo '</div>';

	}


?>

<div>