<?php  
session_start();

# If the user is logged in
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['admin_email'])) {

	

	# Database Connection File
	include "db_conn.php";

    include "php/func-user.php";
    $users = get_all_users($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Users</title>

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
		             href="admin.php">Home</a>
		        </li>
		        <li class="nav-item">
                    <a class="nav-link" href="add-category.php">Add Category</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link active" href="delete-user.php">Delete User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
		      </ul>
		    </div>
		  </div>
		</nav>
        <div class="mt-5"></div>
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


        <?php  if ($users == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no user in the database
		  </div>
        <?php }else {?>


        
		<h4>All Users</h4>
		<table class="table table-bordered shadow">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone Number</th>
					<th>Address</th>
					<th>Another Contact</th>
				</tr>
			</thead>
			<tbody>
			  <?php 
			  $i = 0;
			  foreach ($users as $user) {
			    $i++;
			  ?>
			  <tr>
				<td><?=$i?></td>
				<td><?=$user['name']?></td>
				
				<td><?=$user['email']?></td>
                <td><?=$user['phone_num']?></td>
				<td><?=$user['address']?></td>
                <td><?=$user['another_contact']?></td>
				<td>
					

					<a href="php/delete-user.php?id=<?=$user['ID']?>" 
					   class="btn btn-danger">
				       Delete</a>
				</td>
			  </tr>
			  <?php } ?>
			</tbody>
		</table>
	   <?php }?>

	</div>
</body>
</html>

<?php }else{
  header("Location: login-admin.php");
  exit;
} ?>