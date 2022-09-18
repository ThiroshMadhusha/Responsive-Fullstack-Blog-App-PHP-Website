<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user-id'];

    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // validate form data
    if(!$title){
        $_SESSION['add-post'] = "Create The Post Title";
    }elseif(!$category_id){
        $_SESSION['add-post'] = "Select The Post Category";
    }elseif(!$body){
        $_SESSION['add-post'] = "Add The Post Body Content";
    }elseif(!$thumbnail['name']){
        $_SESSION['add-post'] = "Please Choose The Post Thumbnail";
    }else{

        // work n thumbnail

        // rename the image
        $time = time(); // each image unique
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        // make sure file is an image

        $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);

        if(in_array($extension, $allowed_files)){

            // make sure image is not too big (2mb)
            if($thumbnail['size'] < 2_000_000){
                // upload thumbnail
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);

            }else{
                $_SESSION['add-post'] = "File Size Too Big. It Should Be Less Than 2MB";
            }
        }else{
            $_SESSION['add-post'] ="File Should Be PNG, JPG, JPEG OR WEBP";
        }
    }

    // any error in add post section, back to the redirect add post page
    if($_SESSION['add-post']){
        $_SESSION['add-post-data'] = $_POST;

        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    }else{

        // set all features to 0
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featured =0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // insert post into db
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)){
            $_SESSION['add-post-success'] = "New Post Added Successful..!";

            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }

}

header('location: ' . ROOT_URL . 'admin/add-post.php');
die();