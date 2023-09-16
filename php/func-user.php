<?php

# Get user by ID function
function get_user($con, $id){
    $sql  = "SELECT * FROM user WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() > 0) {
          $user = $stmt->fetch();
    }else {
       $user = 0;
    }
 
    return $user;
}

function get_all_users($conn){
    $sql ="SELECT * FROM user ORDER BY name DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $users= $stmt->fetchAll();
    }else{
        $users= 0;
    }
    return $users;
}

 
 
 
