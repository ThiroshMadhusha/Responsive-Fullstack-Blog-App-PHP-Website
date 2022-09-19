<?php
include 'partials/header.php';

// fetch categories from db
$query= "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>
<!-- End Nav Bar -->

<section class="dashboard">
    <!-- Add successful message -->
    <?php if(isset($_SESSION['add-category-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']);
                    ?>
        </p>
    </div>

    <!-- Add unsuccessful message -->
    <?php elseif(isset($_SESSION['add-category'])) : ?>
    <div class="alert__message error container">
        <p>
            <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?>
        </p>
    </div>
    <!-- Edit category not successful message -->
    <?php elseif(isset($_SESSION['edit-category'])) : ?>
    <div class="alert__message error container">
        <p>
            <?= $_SESSION['edit-category'];
                    unset($_SESSION['edit-category']);
                    ?>
        </p>
    </div>

    <!-- Edit category is successful message -->
    <?php elseif(isset($_SESSION['edit-category-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['edit-category-success'];
                    unset($_SESSION['edit-category-success']);
                    ?>
        </p>
    </div>

    <!-- delete category is successful message -->
    <?php elseif(isset($_SESSION['delete-category-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['delete-category-success'];
                    unset($_SESSION['delete-category-success']);
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
                    <a href="manage-user.php">
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
                    <a href="manage-category.php" class="active">
                        <i class="uil uil-list-ul"></i>
                        <h5>Manage Category</h5>
                    </a>
                </li>

                <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($categories) > 0) : ?>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm success">Edit Category</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Delete Category</a></td>
                    </tr>
                    <?php endwhile ?>

                </tbody>
            </table>

            <?php else : ?>
                <div class="alert__message error"><?= "No Categories Found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

<!-- End category section -->


<?php
include '../partials/footer.php'
?>