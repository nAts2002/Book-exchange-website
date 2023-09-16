<?php
session_start();

if(isset($_POST['email'])&&isset($_POST['password'])){
    include "../db_conn.php";

    include "func-validation.php";
    /* Get data */
    $email = $_POST['email'];
    $password = $_POST['password'];

    $text = "Email";
    $location = "../login-admin.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
    $location = "../login-admin.php";
    $ms = "error";
    is_empty($password, $text, $location, $ms, "");

    $sql = "SELECT *FROM admin WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    if($stmt -> rowCount()==1){
        $admin = $stmt->fetch();
        $admin_id = $admin['ID'];
        $admin_email = $admin['email'];
        $admin_password = $admin['password'];
        if($email === $admin_email){
            if($password == $admin_password){
                $_SESSION['admin_id']=$admin_id;
                $_SESSION['admin_email']=$admin_email;
                header("Location: ../admin.php");
            }else{
                $em = "Incorrect User name or password";
                header("Location: ../login-admin.php?error=$em");
            }
        }else{
            $em = "Incorrect User name or password";
            header("Location: ../login-admin.php?error=$em");
        }
    }else{
        $em = "Incorrect User name or password";
        header("Location: ../login-admin.php?error=$em");
    }


}else{
    header("Location: ../login-admin.php"); # Redirect
}