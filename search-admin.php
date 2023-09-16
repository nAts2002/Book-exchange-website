<?php 
session_start();

# If search key is not set or empty
if (!isset($_GET['key']) || empty($_GET['key'])) {
	header("Location: index.php");
	exit;
}
$key = $_GET['key'];

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = search_books($conn, $key);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="index.php">Trao đổi sách online</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" 
		             aria-current="page" 
		             href="admin.php">Home</a>
		        </li>
		        <li class="nav-item">
                    <a class="nav-link" href="add-category.php">Add Category</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="delete-user.php">Delete User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
		      </ul>
		    </div>
		  </div>
		</nav><br>
		Search result for <b><?=$key?></b>

		<div class="d-flex pt-3">
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5 pdf-list" 
        	     role="alert">
        	     <img src="img/empty-search.png" 
        	          width="100">
        	     <br>
				  The key <b>"<?=$key?>"</b> didn't match to any record
		           in the database
			  </div>
			<?php }else{ ?>
			<div class="pdf-list d-flex flex-wrap">
				<?php foreach ($books as $book) { ?>
				<div class="card m-1">
					<img src="uploads/cover/<?=$book['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">
							<?=$book['title']?>
						</h5>
						<p class="card-text">
							<i><b>By:
								<?php
										echo $book['author_name'];
								?>
							<br></b></i>
							<?=$book['description']?>
							<br><i><b>Category:
								<?php foreach($categories as $category){ 
									if ($category['ID'] == $book['category_id']) {
										echo $category['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
						</p>
						<a href="php/delete-book-admin.php?id=<?=$book['ID']?>" 
					   class="btn btn-danger">
				       Delete</a>

					</div>
				</div>
				<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>