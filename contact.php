<?php  
session_start();



# If book ID is not set
if (!isset($_GET['id'])) {
	#Redirect to user.php page
	header("Location: user.php");
	exit;
}

$id = $_GET['id'];

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$book = get_book($conn, $id);
$owner_id = $book['owner_id'];

include "php/func-user.php";
$user = get_user($conn, $owner_id);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Information</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

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
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Home</a>
		        </li>
				<li class="nav-item">
		          <a class="nav-link" 
		             href="#">Contact</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="#">About</a>
		        </li>
		        <li class="nav-item">
		          <?php if (isset($_SESSION['user_id'])) {?>
		          	<a class="nav-link" 
		             href="user.php">User</a>
		          <?php }else{ ?>
		          <a class="nav-link" 
		             href="login.php">Login</a>
		          <?php } ?>

		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<h1 class="display-4 p-3 fs-3">
		   Chủ sở hữu: <?=$user['name']?>
		</h1>
		<h2 class="display-4 p-3 fs-3">
		   Tên sách: <?=$book['title']?>
		</h2>
		<h3 class="display-4 p-3 fs-3">
		   Thông tin liên hệ:
		</h3>
		<div class="d-flex pt-3">
			<div class="pdf-list d-flex flex-wrap">
				<div class="card m-1">
					<div class="card-body">
						<h5 class="card-title">
							Số điện thoại: <?=$user['phone_num']?>
						</h5>
						<p class="card-text">
							<i><b> Địa chỉ:
							<?=$user['address']?>
							<br></b></i>
							<?=$user['another_contact']?>
							
						</p>
					</div>
				</div>
			</div>

		</div>
		</div>

	</div>
</body>
</html>
