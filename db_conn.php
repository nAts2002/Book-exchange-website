<?php
$sever_name = "localhost";
$user_name = "root";
$pass = "";
$db_name = "trao_doi_sach_db";

#create database connection using PDO
try{
    $conn = new PDO("mysql:host=$sever_name; dbname=$db_name",$user_name,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}