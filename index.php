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
	
		<div class="jumbotron" id="header">
			<h1 id="title">Web-rary<span style="display:inline-block;">Like a regular library, but online...and not free</span></h1>
		</div>
		<div class="col-lg-2 sidebar" id="left-sidebar"></div>
		<div class="col-lg-8" id="main-panel"></div>
		<div class="col-lg-2 sidebar" id="right-sidebar">
		<form method="post" action="searchResults.php">
			<label for="search-select" style="margin-top:15px">Search By:</label> 
			<select name="search-select" id="search-select" class="form-control">
				<option value="title">Title</option>
				<option value="author">Author</option>
				<option value="isbn">ISBN</option>
			</select>
			<input type="text" class="form-control" name="search-box" id="search-box">
			<button type="submit" class="btn" id="search-button">Search</button>
		</form>
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
                  <button type="submit" class="btn btn-default">Log-In</button>
                </form>
                
            
            </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                  <button type="submit" class="btn btn-default">Log-In</button>
                </form>
                
            
            </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    	</div>
  		</div>


  
	</div>

	</body>




</html>