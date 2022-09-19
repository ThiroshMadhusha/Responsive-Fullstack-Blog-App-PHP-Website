<?php 
require 'config/database.php';


if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    // update category id of post that belong to this category
    // delete category, all post are that category is deleted

    $update_query = "UPDATE posts SET category_id=20 WHERE category_id=$id";
    $update_result = mysqli_query($connection, $update_query);

    if(!mysqli_errno($connection)){
        
    
    // delete the category
    $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    $_SESSION['delete-category-success'] = "Deleted Category Successfully..!";

    }

}
header('location: ' . ROOT_URL . 'admin/manage-category.php');
die();