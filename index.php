
<?php include("shared/pageStart.html"); ?>
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
           $mostPopAuthQuery = "SELECT COUNT(dateRented) as cnt, name FROM Authors, Rent, WrittenBy WHERE Authors.id=WrittenBy.authorID AND WrittenBy.ISBN = Rent.ISBN GROUP BY (name) ORDER BY cnt DESC LIMIT 10;";

           $result = $conn->query($mostPopAuthQuery);
           while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<li><a href='searchResults.php?search-select=author&search-box=".$row['name']."'>".$row["name"] . "</a></li>";
        }
        ?>
    </ul>

</h3>
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


<?php include("shared/modalsComm.html"); ?>


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

