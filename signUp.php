<?php 
	require("scripts/connect.php");
?>


	<?php include("shared/pageStart.html"); ?>


			<div class="col-lg-1"></div>
			<div class="col-lg-6" id="sign-up-form" style="padding-top:20px">
				<h1>Enter Your Information</h1>
				<div class="col-lg-12 form-group">
					<label for="username">UserName:</label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Enter Your UserName">
					<label for="pass">Password:</label>
					<input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Your Password">
					<label for="card-type">Card Type</label>
					<select name="card-type" class="form-control" id="card-type">
						<option value="visa">Visa</option>
						<option value="mastercard">MasterCard</option>
						<option value="amex">American Express</option>
						<option value="discover">Discover</option>
					</select>
					<label for="name-on-card">Name on Card:</label>
					<input type="text" class="form-control" name="name-on-card" id="name-on-card" placeholder="Enter Cardholder Name">
					<label for="cc-number">Credit Card Number:</label>
					<input type="text" class="form-control" name="cc-number" id="cc-number" placeholder="Enter Card Number">
					<label for="exp">Expiration Date:</label>
					<div id="exp">
						<label for="month">Month:</label>
						<select name="month" id="month" class="exp-select">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<label for="year">Year:</label>
						<select name="year" id="year" class="exp-select">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
						</select>
					<label for="billing">Billing Address</label>
					<input type="text" class="form-control" name="billing" id="billing" placeHolder="Billing Address">
					<label for="shipping">Shipping Address</label>
					<input type="text" class="form-control" name="shipping" id="shipping" placeHolder="Billing Address">
					<button id="sign-up" style="float:right; margin-top:35px" class="btn btn-primary">Sign Up</button>
				</div>
			</div>
		</div>
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
	
	<?php include("shared/modalsComm.html"); ?>


	</body>
	<script>
	$('#sign-up').click(function() {
		console.log("Signing Up");
		var username = $('#username').val();
		var password = $('#password').val();
		var cardType = $('#card-type').val();
		var name = $('#name-on-card').val();
		var ccNumber = $('#cc-number').val();
		var exp = $('#year').val() + '-' + $('#month').val() + '1';
		var billing = $('#billing').val();
		var shipping = $('#shipping').val();
		$.ajax({
			type: 'post',
			url: 'scripts/addUser.php',
			data: {'username': username, 'password': password, 'cardType': cardType, 'name': name, 'ccNumber': ccNumber, 'exp': exp, 'billing': billing, 'shipping': shipping},
			success: function(data) {
				console.log(data);
			}
		});
	});


		
  $(document).on('click', '#confirmLogOut', function(e) {
    $.ajax({
        type: 'post',
        url: 'scripts/setLoggedOut.php',
        data: {},

        success: function (data) {}

    })

    $('#LoginBtn a').text('Login');
    $('#LoginBtn a').attr('data-target','#myLoginModal');
    $('#accountInfoBtn').attr('style', 'display:none;');
});

  $(document).on('click', '#log-in', function(e) {
     $('#LoginBtn a').text('Login');
     e.preventDefault();
     $('#error-info').empty();
     var userName = $('#myUserName').val();
     var pass = $('#myPassword').val();
     $.ajax({
        type: 'post',
        url: 'scripts/authenticate.php',
        data: {'userName': userName, 'pass': pass},

        success: function(data) {
          var authData = JSON.parse(data);
          if(authData[0] == "")
          {
            $('#error-info').append("<font color='red'><b>INVALID USERNAME</b></font>");
        }
        else if (authData[1] == "")
        {
            $('#error-info').append("<font color='red'><b>INVALID PASSWORD</b></font>");
        }
        else
        {
            $.ajax({
                type: 'post',
                url: 'scripts/setLoggedIn.php',
                data: {},

                success: function (data) {}

            })

           $('#LoginBtn a').text('Logout');
           $('#LoginBtn a').attr('data-target','#logOutMessageModal');
           $('#myLoginModal').modal('hide');
           $('#accountInfoBtn').attr('style', '');
       }
   }

})
 });
	</script>
</html>