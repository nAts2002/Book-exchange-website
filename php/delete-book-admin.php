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
			header("Location: ../admin.php?error=$em");
            exit;
		}else {
             # GET book from Database
			 $sql2  = "SELECT * FROM books
			          WHERE id=?";
			 $stmt2 = $conn->prepare($sql2);
			 $stmt2->execute([$id]);
			 $the_book = $stmt2->fetch();

			 if($stmt2->rowCount() > 0){
                # DELETE the book from Database
				$sql  = "DELETE FROM books
				         WHERE id=?";
				$stmt = $conn->prepare($sql);
				$res  = $stmt->execute([$id]);

			     if ($res) {
			     	# delete the current book_cover and the file
                    $cover = $the_book['cover'];
                    $c_b_c = "../uploads/cover/$cover";
                    
                    unlink($c_b_c);


			     	# success message
			     	$sm = "Successfully removed!";
					header("Location: ../admin.php?success=$sm");
		            exit;
			     }else{
			     	# Error message
			     	$em = "Unknown Error Occurred!";
					header("Location: ../admin.php?error=$em");
		            exit;
			     }
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
  header("Location: ../login-admin.php");
  exit;
}