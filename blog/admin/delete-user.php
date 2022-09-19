<?php

require 'config/database.php';

if(isset($_GET['id'])){
    // fetch user form db
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // only 1 udser 
    if(mysqli_num_rows($result) ==1 ){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        // delete image variable
        if($avatar_path){
            unlink($avatar_path);
        }
    }

    // FOR LATER
    // fetch all thumbnail of user's post and thelete it
    // user delete. All data that user are deleted

    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnail_result = mysqli_query($connection, $thumbnails_query);

    if(mysqli_num_rows($thumbnail_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];

            // delete thumbnail from images folder

            if($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }


    
    // delete user from dbb
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if(mysqli_errno($connection)){
        $_SESSION['delete-user'] = "Couldnt '{$user['firstname']}' '{$user['lastname']}'. Try Again..!";
    }else{
        $_SESSION['delete-user-success'] = "Deleted '{$user['firstname']}' '{$user['lastname']}' User Successfully..!";
    }
    
}

header('location: ' . ROOT_URL . 'admin/manage-user.php');
die();