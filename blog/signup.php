<?php
require 'config/constants.php';

// get back form data
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delete sessions
unset($_SESSION['signup-data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/signup.css" />

    <!-- icon cloud cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign Up</h2>

            <?php if(isset($_SESSION['signup'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['signup'];
                        unset($_SESSION['signup']);                        
                        ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" placeholder="Enter Your First Name" name="firstname" value="<?= $firstname ?>" />
                <input type="text" placeholder="Enter Your Last Name" name="lastname" value="<?= $lastname ?>" />
                <input type="text" placeholder="Enter Your User Name" name="username" value="<?= $username ?>" />
                <input type="email" placeholder="Enter Your Email Address" name="email" value="<?= $email ?>" />
                <input type="password" placeholder="Enter Password" name="createpassword"
                    value="<?= $createpassword ?>" />
                <input type="password" placeholder="Confirm Password" name="confirmpassword"
                    value="<?= $confirmpassword ?>" />

                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" id="avatar" name="avatar" />
                </div>
                <button type="submit" class="btn" name="submit">Sign Up</button>
                <small>Already Have an Account ? <a href="signin.php">Sign In</a></small>
            </form>
        </div>
    </section>
</body>

</html>