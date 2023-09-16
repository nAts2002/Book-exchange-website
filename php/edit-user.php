<?php  
session_start();

# If the user is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";


	if (isset($_POST['name'])          &&
        isset($_POST['user_email'])       &&
        isset($_POST['phone_num'])  &&
        isset($_POST['address'])    &&
        isset($_POST['password'])    &&
        isset($_POST['contact'])) {
        
        $id= $_SESSION['user_id'];

		$name        = $_POST['name'];
		$email       = $_POST['user_email'];
		$num         = $_POST['phone_num'];
        $addr        = $_POST['address'];
        $contact     = $_POST['contact'];
        $password    = $_POST['password'];

        #simple form Validation
        $text = "User name";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($name, $text, $location, $ms, "");

		$text = "User email";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($email, $text, $location, $ms, "");

		$text = "User number";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($num, $text, $location, $ms, "");
		      
        $sql = "UPDATE user
                SET name=?,
                    email=?,
                    password=?,
                    phone_num=?,
                    address=?,
                    another_contact=?
                WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $res  = $stmt->execute([$name, $email, $password, $num, $addr, $contact, $id ]);

        
        if ($res) {
        # success message
        $sm = "Successfully updated!";
        header("Location: ../edit-user.php?success=$sm&id=$id");
        exit;
        }else{
        # Error message
        $em = "Unknown Error Occurred!";
        header("Location: ../edit-user.php?error=$em&id=$id");
        exit;
        }


		
        }else {
        header("Location: ../user.php");
        exit;
        }

}else{
  header("Location: ../login.php");
  exit;
}