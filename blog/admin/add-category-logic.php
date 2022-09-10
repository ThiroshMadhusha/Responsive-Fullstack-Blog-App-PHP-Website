<?php
require 'config/database.php';

if(isset($_POST['submit'])){

    // get form data
    $title = filter_var($_POST['title'],FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['add-category'] = "Please Add The Title Of Post";
    }elseif(!$description){
        $_SESSION['add-category'] = "Please Add The Description Of Post";
        
    }
    // redirect back to category form with data with that problem
    if(isset($_SESSION['add-category'])){
        $_SESSION['add-category-data'] = $_POST;
        
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
        
    }else{
        // insert category into db
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['add-category'] = "Couldn't Add Category Data";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        }else{
            $_SESSION['add-category-success'] = "Category $title Added Successful..!!";
            header('location: ' . ROOT_URL . 'admin/manage-category.php');
            die();
        }
    }

}