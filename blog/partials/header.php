<?php
require 'config/database.php';

// fetch current user from db
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}
?>

<!-- Add Repeating content -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Travel Sri Lanka</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/about.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/blog.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/signup.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/post.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/category-post.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/manage-category.css" />


    <!-- icon cloud cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>

    <!-- Ceate Nav Bar Component -->
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">Travel Sri Lanka</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>">Home</a></li>
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>service.php">Service</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])) : ?>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>" alt="profile" />
                    </div>

                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</i></a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Logout</i></a></li>

                    </ul>
                </li>
                <?php else : ?>
                <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>

                <?php endif ?>
            </ul>

            <!-- mobile view -->
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>

        </div>
    </nav>

    <!-- End Nav Bar -->