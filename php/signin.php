<?php

if( isset($_POST['email'])&&
    isset($_POST['password'])&&
    isset($_POST['name'])&&
    isset($_POST['address'])&&
    isset($_POST['phone_num'])){
    include "../db_conn.php";

    include "func-validation.php";
    /* Get data */
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $num = $_POST['phone_num'];

    if(isset($_POST['contact'])){
        $contact = $_POST['contact'];
    }else $contact = "";

    $text = "Email";
    $location = "../signin.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
    $location = "../signin.php";
    $ms = "error";
    is_empty($password, $text, $location, $ms, "");

    $text = "Name";
    $location = "../signin.php";
    $ms = "error";
    is_empty($name, $text, $location, $ms, "");

    $text = "Phone number";
    $location = "../signin.php";
    $ms = "error";
    is_empty($num, $text, $location, $ms, "");

    $text = "Address";
    $location = "../signin.php";
    $ms = "error";
    is_empty($address, $text, $location, $ms, "");

    $sql  = "INSERT INTO user ( name,
								email,
							    password,
								phone_num,
								address,
                                another_contact)
					VALUES (?,?,?,?,?,?)";
    $res = $conn->prepare($sql);
    $res->execute([$name, $email, $password, $num, $address, $contact]);

    if ($res) {
		# success message
		$sm = "Successfully signin!";
		header("Location: ../signin.php?success=$sm");
		exit;
		}else{
		# Error message
		$em = "Unknown Error Occurred!";
		header("Location: ../signin.php?error=$em");
		exit;
		}
}else{
    header("Location: ../signin.php"); # Redirect
}