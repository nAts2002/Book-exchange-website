<?php  
session_start();

# If the user is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";

    # Category helper function
	include "php/func-category.php";
    $categories = get_all_categories($conn);


    if (isset($_GET['title'])) {
    	$title = $_GET['title'];
    }else $title = '';

    if (isset($_GET['desc'])) {
    	$desc = $_GET['desc'];
    }else $desc = '';

    if (isset($_GET['category_id'])) {
    	$category_id = $_GET['category_id'];
    }else $category_id = 0;

    if (isset($_GET['author_name'])) {
    	$author_name = $_GET['author_name'];
    }else $author_name = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Book</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="user.php">Trao đổi sách online</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Home</a>
				<li class="nav-item">
                <a class="nav-link" href="add-book.php">Add Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit-user.php">Edit Information</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="my-book.php">My Books</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/add-book.php"
           method="post"
           enctype="multipart/form-data" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center pb-5 display-4 fs-3">
     		Add New Book
     	</h1>
     	<?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           Book Title
		           </label>
		    <input type="text" 
		           class="form-control"
		           value="<?=$title?>" 
		           name="book_title">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Description
		           </label>
		    <input type="text" 
		           class="form-control"
		           value="<?=$desc?>" 
		           name="book_description">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Author
		           </label>
		    <input type="text" 
		           class="form-control"
		           value="<?=$author_name?>" 
		           name="book_author">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Category
		           </label>
		    <select name="book_category"
		            class="form-control">
		    	    <option value="0">
		    	    	Select category
		    	    </option>
		    	    <?php 
                    if ($categories == 0) {
                    	# Do nothing!
                    }else{
		    	    foreach ($categories as $category) { 
		    	    	if ($category_id == $category['ID']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$category['ID']?>">
		    	    	  <?=$category['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$category['ID']?>">
							<?=$category['name']?>
						</option>
		    	   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Cover
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="book_cover">
		</div>

		
	    <button type="submit" 
	            class="btn btn-primary">
	            Add Book</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>