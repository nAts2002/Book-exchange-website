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


	if (isset($_POST['book_id'])          &&
        isset($_POST['book_title'])       &&
        isset($_POST['book_description'])  &&
        isset($_POST['book_author'])    &&
        isset($_POST['book_category'])) {
        
        $id          = $_POST['book_id'];
        $title       = $_POST['book_title'];
        $description = $_POST['book_description'];
        $author      = $_POST['book_author'];
        $category    = $_POST['book_category'];

        #simple form Validation
        $text = "Book title";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($title, $text, $location, $ms, "");

		$text = "Book description";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($description, $text, $location, $ms, "");

		$text = "Book author";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($author, $text, $location, $ms, "");

		$text = "Book category";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($category, $text, $location, $ms, "");
		      

        $sql = "UPDATE books
                SET title=?,
                    author_name=?,
                    description=?,
                    category_id=?
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $res  = $stmt->execute([$title, $author, $description, $category, $id]);

        if ($res) {
        # success message
        $sm = "Successfully updated!";
        header("Location: ../edit_book.php?success=$sm&id=$id");
        exit;
        }else{
        # Error message
        $em = "Unknown Error Occurred!";
        header("Location: ../edit_book.php?error=$em&id=$id");
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