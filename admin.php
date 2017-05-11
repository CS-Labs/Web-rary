<?php
	include("shared/pageStart.html");
?>
	<div class="col-lg-12" style="height:50px"></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<h1>Add An Author:</h1>
		<label for="author-name" class="admin-object">Name:</label>
		<input type="text" class="form-control" name="author-name" id="author-name">
		<label for="gender" class="admin-object">Gender:</label>
		<input type="text" class="form-control" name="gender" id="gender">
		<button class="btn btn-primary admin-object" id="author-submit">Add Author</button>
	</div>
	<div class="col-lg-12" id="add-author-text"></div>

	<div class="col-lg-12" style="height:50px"></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<h1>Add A Publisher:</h1>
		<label for="publisher-name" class="admin-object">Name:</label>
		<input type="text" class="form-control" name="publisher-name" id="publisher-name">
		<label for="address" class="admin-object">Address:</label>
		<input type="text" class="form-control" name="address" id="address">
		<button class="btn btn-primary admin-object" id="publisher-submit">Add Publisher</button>
	</div>
	<div class="col-lg-12" id="add-publisher-text"></div>

	<div class="col-lg-12" style="height:50px"></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<h1>Add A Book:</h1>
		<label for="isbn" class="admin-object">ISBN:</label>
		<input type="text" class="form-control" name="isbn" id="isbn">
		<label for="book-title" class="admin-object">Title:</label>
		<input type="text" class="form-control" name="book-title" id="book-title">
		<label for="book-author" class="admin-object">Author:</label>
		<input type="text" class="form-control" name="book-author" id="book-author">
		<label for="book-publisher" class="admin-object">Publisher:</label>
		<input type="text" class="form-control" name="book-publisher" id="book-publisher">
		<label for="genre" class="admin-object">Genre:</label>
		<input type="text" class="form-control" name="genre" id="genre">
		<label for="num-pages" class="admin-object">Number of Pages:</label>
		<input type="text" class="form-control" name="num-pages" id="num-pages">
		<label for="pub-date" class="admin-object">Date Published:</label>
		<input type="text" class="form-control" name="pub-date" id="pub-date">
		<label for="synopsis" class="admin-object">Synopsis:</label>
		<textarea rows="10" class="form-control" name="synopsis" id="synopsis"></textarea>
		<button class="btn btn-primary admin-object" id="book-submit">Add Book</button>
	</div>
	<div class="col-lg-12" id="add-book-text"></div>

	<div class="col-lg-12" style="height:50px"></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<h1>Delete A Book:</h1>
		<label for="delete-isbn" class="admin-object">ISBN:</label>
		<input type="text" class="form-control" name="delete-isbn" id="delete-isbn">
		<button class="btn btn-danger admin-object" id="del-book">Delete</button>
	</div>
	<div class="col-lg-12" id="delete-book-text"></div>
	

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
	</div>

</body>

<script>
	$('#book-submit').click(function() {
		var isbn = $('#isbn').val();
		var title = $('#book-title').val();
		var author = $('#book-author').val();
		var publisher = $('#book-publisher').val();
		var genre = $('#genre').val();
		var numPages = $('#num-pages').val();
		var pubDate = $('#pub-date').val();
		var synopsis = $('#synopsis').val();
		$.ajax({
			type: 'post',
			url: 'scripts/addBook.php',
			data: {'isbn': isbn, 'title': title, 'author': author, 'publisher': publisher, 'genre': genre, 'numPages': numPages, 'pubDate': pubDate, 'synopsis': synopsis},
			success: function(data) {
				$('#add-book-text').append('<p>'+data+'</p>');
			}
		})
	});
	$('#author-submit').click(function() {
		var author = $('#author-name').val();
		var gender = $('#gender').val();
		$.ajax({
			type: 'post',
			url: 'scripts/addAuthor.php',
			data: {'author': author, 'gender': gender},
			success: function(data) {
				$('#add-author-text').append('<p>'+data+'</p>');
			}
		})

	});
	$('#publisher-submit').click(function() {
		var pubName = $('#publisher-name').val();
		var address = $('#address').val();
		$.ajax({
			type: 'post',
			url: 'scripts/addPublisher.php',
			data: {'pubName': pubName, 'address': address},
			success: function(data) {
				$('#add-publisher-text').append('<p>'+data+'</p>');
			}
		})
	});
	$('#del-book').click(function() {
		var isbn = $('#delete-isbn').val();
		$.ajax({
			type: 'post',
			url: 'scripts/deleteBook.php',
			data: {'isbn': isbn},
			success: function(data) {
				$('#delete-book-text').append('<p>'+data+'</p>');
			}
		});
	});

</script>

</html>
