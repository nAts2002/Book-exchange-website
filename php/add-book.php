<?php  
session_start();

# If the user is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

	include "func-file-upload.php";

	$user_id = $_SESSION['user_id'];



    
	if (isset($_POST['book_title'])       &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author'])      &&
        isset($_POST['book_category'])&&
		isset($_FILES['book_cover'])) {
		
		$title       = $_POST['book_title'];
		$description = $_POST['book_description'];
		$author      = $_POST['book_author'];
		$category    = $_POST['book_category'];

		# making URL data format
		$user_input = 'title='.$title.'&category_id='.$category.'&desc='.$description.'&author_name='.$author;

		#simple form Validation

        $text = "Book title";
        $location = "../add-book.php";
        $ms = "error";
		is_empty($title, $text, $location, $ms, $user_input);

		$text = "Book description";
        $location = "../add-book.php";
        $ms = "error";
		is_empty($description, $text, $location, $ms, $user_input);

		$text = "Book author";
        $location = "../add-book.php";
        $ms = "error";
		is_empty($author, $text, $location, $ms, $user_input);

		$text = "Book category";
        $location = "../add-book.php";
        $ms = "error";
		is_empty($category, $text, $location, $ms, $user_input);

		$allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);
		$book_cover_URL = $book_cover['data'];
		if ($book_cover['status'] == "error") {
	    	$em = $book_cover['data'];

	    	
	    	header("Location: ../add-book.php?error=$em&$user_input");
	    	exit;
		}else{
                
			# Insert the data into database
			$sql  = "INSERT INTO books (title,
										author_name,
										description,
										category_id,
										owner_id,
										cover)
						VALUES (?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$title, $author, $description, $category, $user_id, $book_cover_URL]);

			
			if ($res) {
			# success message
			$sm = "The book successfully created!";
			header("Location: ../add-book.php?success=$sm");
			exit;
			}else{
			# Error message
			$em = "Unknown Error Occurred!";
			header("Location: ../add-book.php?error=$em");
			exit;
			}
		}
	}else {
      header("Location: ../user.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}