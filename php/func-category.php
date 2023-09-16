<?php
function get_all_categories($conn){
    $sql ="SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $categories= $stmt->fetchAll();
    }else{
        $categories= 0;
    }
    return $categories;
}
# Get category by ID
function get_category($con, $id){
    $sql  = "SELECT * FROM categories WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() > 0) {
          $category = $stmt->fetch();
    }else {
       $category = 0;
    }
 
    return $category;
 }