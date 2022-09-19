<?php
require 'config/database.php';

// make edit post button is clicked
if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_feactured to 0 , if it was unchecked

    $is_featured = $is_featured == 1 ?: 0;

    // check and validate input values

    if(!$title){
        $_SESSION['edit-post'] = "Couldn't Update Post. Invalid Form Data in Edit Post Page..!";
    }elseif(!$category_id){
        $_SESSION['edit-post'] = "Couldn't Update Post. Invalid Form Data in Edit Post Page..!";
    }elseif(!$body){
        $_SESSION['edit-post'] = "Couldn't Update Post. Invalid Form Data in Edit Post Page..!";
    }else{

        // delete ecisting thumbnail
        if($thumbnail['name']){
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }

            // work on new thumbnail
            // rename image
            $time = time();

            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);

            if(in_array($extension, $allowed_files)){

                // make sure avatar is not large
                if($thumbnail['size'] < 2000000){

                    // upload avatar
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-post'] = "Couldn't Update Post. Thumbnail Size Too Big. Add Less than 2mb thumbnail";
                }

            }else{
                $_SESSION['edit-post'] = "Couldn't Update Post. Thumbnail Should be PNG, JPG, JPEG or WEBP File Type";
            }
        }
    }

    if($_SESSION['edit-post']){
        // redirect to managee from page is invalid
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }else{
        // set is_featured of all post to 0, if is_featured for this post is 1
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // set thumbnail name, if a new one was uploaded
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE posts SET title='$title', body='$body', thumbnail = '$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }
    
    if(!mysqli_errno($connection)){
        $_SESSION['edit-post-success'] = "Post Updated Successfully..!";
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();