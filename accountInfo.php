<?php 
require("scripts/connect.php");
if(isset($_GET['search-box'])) $searchString = $_GET['search-box'];
if(isset($_GET['search-select'])) $searchSelect = $_GET['search-select'];
?>


<?php include("shared/pageStart.html"); ?>


		<h2 align="center"> Payment Info </h2>
		<p>Name on Card: </p>
		<p>Card Type: </p>
		<p>Card Number: </p>
		<p>Expiration Date: </p>
		<p>Billing Address: </p>
		<p>Shipping Address: </p>
		<div class="col-md-12 text-center">
			<button type="button" class="btn btn-primary">Edit Payment Info</button>
		</div>
		<div class="col-sm-12 text-center" id = "emptyRow" "></div>
		<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />	
		<h2 align="center"> Account Info </h2>
		<p>Username: </p>
		<p>Password: </p>
		<div class="col-md-12 text-center">
			<button type="button" class="btn btn-primary">Edit Account Info</button>
		</div>
		<div class="col-sm-12 text-center" id = "emptyRow" "></div>
		<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />	
		<h2 align="center"> Subscription Info </h2>
		<p>Subscription Status:
			<p>Start Date: </p>
			<p>Expiration Date: </p>
					<div class="col-md-12 text-center">
			<button type="button" class="btn btn-danger">Cancel Subscription</button>
			<button type="button" class="btn btn-danger">Erase all Info</button>
		</div>

			<div class="col-sm-12 text-center" id = "emptyRow" "></div>
			<hr style="width: 95%; color: black; height: 2px; background-color:blue;" />	
			<h2 align="center"> Rental History </h2>
		</div>
		<div class="col-lg-2 sidebar" id="right-sidebar"></div>

<?php include("shared/modalsComm.html"); ?>


		<!-- Either have popup to edit the information or have edit box next to it? !-->

	</body>

	<script>
		
	
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





