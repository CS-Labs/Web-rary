
<html>
<head>
  <title>Webrary</title>
  <link rel="stylesheet" type="text/css" href="css/index.css"/>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
  <script src="js/jquery-1.12.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/app.js"></script>
</head>
<body bgcolor=white>
   <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li id = 'accountInfoBtn' style="display:none;"><a href="accountInfo.php">Account-Info</a></li>
        <li><a href="signUp.php">Sign-Up</a></li>
        <li id = 'LoginBtn'><a data-toggle="modal" data-target="#myLoginModal" href="#">Login</a></li>
    </ul>
</div>

<div class="jumbotron" style="margin-bottom: 0!important" id="header">
 <h1 id="title">Web-rary<span style="display:inline-block;">Like a regular library, but online...and not free</span></h1>
</div>
<div class="col-lg-12" style="height:30px;background-color:#bbb"></div>
<div class="col-lg-2 sidebar" id="left-sidebar"></div>
<div class="col-lg-8" id="main-panel">
    <div class="col-lg-12 pop-genre">
        <h3> Current Most Popular Genre:          
            <?php 
            require("scripts/connect.php");
            $mostPopGenreQuery = "SELECT genre FROM (SELECT genre, COUNT(genre) cnt FROM Books GROUP BY genre HAVING cnt = (SELECT MAX(cnt) FROM (SELECT COUNT(genre) as cnt FROM Books GROUP By genre) as a1))as a2;";
            
            $result = $conn->query($mostPopGenreQuery);
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo  "<a href='searchResults.php?search-select=genre&search-box=".$row["genre"]."'>".$row["genre"]."</a>";
            }
            ?>
            
        </h3>
    </div>
    <div class="col-lg-6 book-info" ><h3>Top Ten Most Popular Authors</h3>
        <ul id="author-list">
         <?php 
         $mostPopAuthQuery = "SELECT name FROM (SELECT *, COUNT(dateRented) as cnt FROM (SELECT * FROM Authors, WrittenBy WHERE id = authorID) as a1 NATURAL JOIN Rent GROUP BY (name) ORDER BY cnt DESC LIMIT 10) as a2;";
         
         $result = $conn->query($mostPopAuthQuery);
         while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<li><a href='searchResults.php?search-select=author&search-box=".$row['name']."'>".$row["name"] . "</a></li>";
        }
        ?>
    </ul>

</div>
<div class="col-lg-6 book-info" ><h3>List of Genres Offered</h3>
    <ul>
       <?php 
       $getGenresQuery = "SELECT DISTINCT genre FROM Books;";   
       $result = $conn->query($getGenresQuery);
       while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          echo  "<li><a href='searchResults.php?search-select=genre&search-box=".$row['genre']."'>".$row["genre"]  . "</a></li>";
      }
      ?>
  </ul>
</div>
</div>
<div class="col-lg-2 sidebar" id="right-sidebar">
  <form method="get" action="searchResults.php">
     <label for="search-select" style="margin-top:15px">Search By:</label> 
     <select name="search-select" id="search-select" class="form-control">
        <option value="title">Title</option>
        <option value="author">Author</option>
        <option value="isbn">ISBN</option>
        <option value="genre">genre</option>
    </select>
    <input type="text" class="form-control" name="search-box" id="search-box">
    <button type="submit" class="btn" id="search-button">Search</button>
</form>
</div>

<!-- Modal -->
<div class="modal fade" id="logOutMessageModal" role="dialog">
  <div class="modal-dialog">
      
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">You have been succesfully logged out.</h4>
    </div>
    <div class="modal-body">
        <p>Have a nice day!</p>
    </div>
</div>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myLoginModal" role="dialog">
    <div class="modal-dialog">
        
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter Your Credentials</h4>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        
        <form role="form">
          <div class="form-group">
            <label for="myUserName">Username</label>
            <input type="Username" class="form-control"
            id="myUserName" placeholder="Enter Username"/>
        </div>
        <div class="form-group">
            <label for="myPassword">Password</label>
            <input type="password" class="form-control"
            id="myPassword" placeholder="Password"/>
        </div>
        <button id="log-in" class="btn btn-default">Log-In</button>
    </form>
    
    
</div>
<div class="modal-footer">
    <div id = 'error-info'></div>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

</body>
<script>
  var loggedIn; //Global.
  $(document).ready(function(){
    loggedIn = false;
})

  $(document).on('click', '#LoginBtn', function (e) {
    if(loggedIn)
    {
      loggedIn = false;
      $('#LoginBtn a').text('Login');
      $('#LoginBtn a').attr('data-target','#myLoginModal');
      $('#accountInfoBtn').attr('style', 'display:none;');
  }
})

  $(function(){
      $('#logOutMessageModal').on('show.bs.modal', function(){
          var myModal = $(this);
          clearTimeout(myModal.data('hideInterval'));
          myModal.data('hideInterval', setTimeout(function(){
              myModal.modal('hide');
          }, 2000));
      });
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
     loggedIn = true;
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

