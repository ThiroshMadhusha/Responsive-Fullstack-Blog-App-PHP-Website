<?php
require 'config/database.php';

// sign in button click ?

if(isset($_POST['submit'])){
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$username_email){
        $_SESSION['signin'] = "Enter Valid Username Or Email";
    }elseif(!$password){
        $_SESSION['signin'] = "Password Required";

    }else{
        // fetch user from db
        $fetch_user_query = "SELECT * FROM users WHERE username = '$username_email' OR email = '$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result)==1){
            // convert the record into array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            // compare password with db password
            if(password_verify($password, $db_password)){
                // set session for accet control

                $_SESSION['user-id'] = $user_record['id'];

                // user is admin or not
                if($user_record['is_admin'] == 1){
                    $_SESSION['user_is_admin'] = true;
                }
                // log user
                header('location: ' . ROOT_URL . 'admin/');
            }else{
            $_SESSION['signin'] = "Incorrect Password. Checked Again..!";
        }

        }else{
            $_SESSION['signin'] = "User Not Found ..!";
        }
    }
    // if any problem, redirect to sign in  page
    if(isset($_SESSION['signin'])){
        $_SESSION['signin-data']=$_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
}else{
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}