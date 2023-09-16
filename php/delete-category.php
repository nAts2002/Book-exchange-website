<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['admin_email'])) {

	# Database Connection 
	include "../db_conn.php";


	if (isset($_GET['id'])) {
	
		$id = $_GET['id'];

		#simple form Validation
		if (empty($id)) {
			$em = "Error Occurred!";
			header("Location: ../admin.php?error=$em");
            exit;
		}else {
            # DELETE the category from Database
			$sql  = "DELETE FROM categories
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$id]);

		     if ($res) {
		     	# success message
		     	$sm = "Successfully removed!";
				header("Location: ../admin.php?success=$sm");
	            exit;
			 }else {
			 	$em = "Error Occurred!";
			    header("Location: ../admin.php?error=$em");
                exit;
			 }
             
		}
	}else {
      header("Location: ../admin.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}