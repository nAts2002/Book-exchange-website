<?php
session_start();

if(isset($_POST['email'])&&isset($_POST['password'])){
    include "../db_conn.php";

    include "func-validation.php";
    /* Get data */
    $email = $_POST['email'];
    $password = $_POST['password'];

    $text = "Email";
    $location = "../login.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
    $location = "../login.php";
    $ms = "error";
    is_empty($password, $text, $location, $ms, "");

    $sql = "SELECT *FROM user WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    if($stmt -> rowCount()==1){
        $user = $stmt->fetch();
        $user_id = $user['ID'];
        $user_email = $user['email'];
        $user_password = $user['password'];
        if($email === $user_email){
            if($password == $user_password){
                $_SESSION['user_id']=$user_id;
                $_SESSION['user_email']=$user_email;
                header("Location: ../user.php");
            }else{
                $em = "Incorrect User name or password";
                header("Location: ../login.php?error=$em");
            }
        }else{
            $em = "Incorrect User name or password";
            header("Location: ../login.php?error=$em");
        }
    }else{
        $em = "Incorrect User name or password";
        header("Location: ../login.php?error=$em");
    }


}else{
    header("Location: ../login.php"); # Redirect
}