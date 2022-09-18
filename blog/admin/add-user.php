<?php
include 'partials/header.php';

// get back form data
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
// $userrole = $_SESSION['add-user-data']['userrole'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);

?>


<!-- Add Post Form -->
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>

        <?php if(isset($_SESSION['add-user'])) : ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-user'];
                unset($_SESSION['add-user']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" placeholder="Enter Your First Name" name="firstname" value="<?= $firstname ?>" />
            <input type="text" placeholder="Enter Your Last Name" name="lastname" value="<?= $lastname ?>" />
            <input type="text" placeholder="Enter Your User Name" name="username" value="<?= $username ?>" />
            <input type="email" placeholder="Enter Your Email Address" name="email" value="<?= $email ?>" />
            <input type="password" placeholder="Enter Password" name="createpassword" value="<?= $createpassword ?>" />
            <input type="password" placeholder="Confirm Password" name="confirmpassword"
                value="<?= $confirmpassword ?>" />

            <select name="userrole">

                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar" name="avatar" />
            </div>
            <button type="submit" class="btn" name="submit">Add User</button>

        </form>
    </div>
</section>

<!-- End Form -->


<!-- Footer -->
<?php
include '../partials/footer.php'
?>