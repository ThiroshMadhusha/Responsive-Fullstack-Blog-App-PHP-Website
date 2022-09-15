<?php
include 'partials/header.php';

// fetch user in db but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
?>

<!-- End Nav Bar -->

<section class="dashboard">

    <!-- add user is successful -->
    <?php if(isset($_SESSION['add-user-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['add-user-success'];
              unset($_SESSION['add-user-success']);
              ?>
        </p>
    </div>

    <!-- edit user details successfull -->

    <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                    ?>
        </p>
    </div>

    <!-- edit user details not successfull -->

    <?php elseif(isset($_SESSION['edit-user'])) : ?>
    <div class="alert__message error container">
        <p>
            <?= $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                    ?>
        </p>
    </div>

    <!-- delete user details not successfull -->

    <?php elseif(isset($_SESSION['delete-user'])) : ?>
    <div class="alert__message error container">
        <p>
            <?= $_SESSION['delete-user'];
                    unset($_SESSION['delete-user']);
                    ?>
        </p>
    </div>
    <!-- delete user details successfull -->

    <?php elseif(isset($_SESSION['delete-user-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['delete-user-success'];
                    unset($_SESSION['delete-user-success']);
                    ?>
        </p>
    </div>

    <?php endif ?>
    <div class="container dashboard__container">
        <button class="sidebar__toggle" id="show__sidebar-btn"><i class="uil uil-angle-right-b"></i></button>
        <button class="sidebar__toggle" id="hide__sidebar-btn"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php">
                        <i class="uil uil-edit"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <i class="uil uil-create-dashboard"></i>
                        <h5>Manage Post</h5>
                    </a>
                </li>

                <?php if(isset($_SESSION['user_is_admin'])) : ?>

                <li>
                    <a href="add-user.php">
                        <i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-user.php" class="active">
                        <i class="uil uil-user-arrows"></i>
                        <h5>Manage Users</h5>
                    </a>
                </li>
                <li>
                    <a href="add-category.php">
                        <i class="uil uil-edit"></i>
                        <h5>Add Category</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-category.php">
                        <i class="uil uil-list-ul"></i>
                        <h5>Manage Category</h5>
                    </a>
                </li>

                <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Users</h2>
            <?php if(mysqli_num_rows($users) > 0) : ?>
            <table>
                <thead>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Admin</th>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?= "{$user['firstname']} {$user['lastname']}" ?> </td>
                        <td> <?= $user['username'] ?> </td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>"
                                class="btn sm success">Edit User</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>"
                                class="btn sm danger">Delete User</a></td>
                        <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>

            <?php else : ?>
                <div class="alert__message error"><?= "No Users Founded..!" ?></div>

                <?php endif ?>
        </main>
    </div>
</section>

<!-- End category section -->

<?php
include '../partials/footer.php'
?>