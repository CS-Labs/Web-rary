<?php 
require("scripts/connect.php");
if(isset($_GET['search-box'])) $searchString = $_GET['search-box'];
if(isset($_GET['search-select'])) $searchSelect = $_GET['search-select'];
?>


<?php include("shared/pageStart.html"); ?>

<?php include("scripts/getAccountInfo.php") ?>

<div class="col-lg-2 sidebar" id="right-sidebar"></div>

<?php include("shared/modalsComm.html"); ?>


</body>

<script>
  $.ajax({
    type: 'post',
    url: 'scripts/getAccountInfo.php',
    data: {},

    success: function (data) {}

  })


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

  $(document).on('click', '.return-btn', function() {

    var rentId = $(this).attr('rentId');

    $.ajax({
      type: 'post',
      url: 'scripts/returnBook.php',
      data: {'rentId': rentId},

      success: function (data) {
        var dateReturned = JSON.parse(data);
        $("#"+rentId).html(dateReturned);
      }

    })
  });

    $(document).on('click', '#updateAccountInfoBtn', function() {

    var userName = $('#username').val();
    var pass = $('#password').val();

    $.ajax({
      type: 'post',
      url: 'scripts/updateUserInfo.php',
      data: {'username': userName, 'password': pass},

      success: function (data) {}

    })
    });

   $(document).on('click', '#updatePaymentInfoBtn', function() {

    var nameOnCard = $('#nameOnCard').val();
    var cardType = $('#cardType').val();
    var ccNumber = $('#ccNumber').val();
    var expDate = $('#expDate').val();
    var billingAddress = $('#billingAddress').val();

    $.ajax({
      type: 'post',
      url: 'scripts/updatePaymentInfo.php',
      data: {'nameOnCard': nameOnCard, 'cardType': cardType, 'ccNumber' : ccNumber, 'expDate' : expDate, 'billingAddress' : billingAddress},

      success: function (data) {
        console.log(data);

      }

    })
    });

    $(document).on('click', '#cancelSubBtn', function() {

      var status = $('#statusCell').text();

      if(status != 'Inactive')
      {
        $.ajax({
        type: 'post',
        url: 'scripts/updateStatus.php',
        data: {},

        success: function (data) {
        }
        })

      }

      $("#statusCell").html("Inactive");
    });


</script>

</html>





