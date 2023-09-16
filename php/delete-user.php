<?php  
session_start();

if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['admin_email'])) {

	# Database Connection File
	include "../db_conn.php";


	if (isset($_GET['id'])) {
	
		$id = $_GET['id'];

		#simple form Validation
		if (empty($id)) {
			$em = "Error Occurred!";
			header("Location: ../delete-user.php?error=$em");
            exit;
		}else {
            
				$sql  = "DELETE FROM user
                        WHERE id=?;
                        DELETE FROM books
				        WHERE owner_id=?;";
				$stmt = $conn->prepare($sql);
				$res  = $stmt->execute([$id, $id]);

			     if ($res) {
			     	# success message
			     	$sm = "Successfully removed!";
					header("Location: ../delete-user.php?success=$sm");
		            exit;
			     }else{
			     	# Error message
			     	$em = "Unknown Error Occurred!";
					header("Location: ../delete-user.php?error=$em");
		            exit;
			     }
			
             
		}
	}else {
      header("Location: ../delete-user.php");
      exit;
	}

}else{
  header("Location: ../login-admin.php");
  exit;
}