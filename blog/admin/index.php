<?php
include 'partials/header.php';

// fetch current users post from db

$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>


<!-- End Nav Bar -->

<section class="dashboard">

<!-- add posts is successful -->
    <?php if(isset($_SESSION['add-post-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['add-post-success'];
              unset($_SESSION['add-post-success']);
              ?>
        </p>
    </div>

    <!-- Edit posts is successful -->
    <?php elseif(isset($_SESSION['edit-post-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['edit-post-success'];
              unset($_SESSION['edit-post-success']);
              ?>
        </p>
    </div>

    <!-- add posts is successful -->
    <?php elseif(isset($_SESSION['edit-post'])) : ?>
    <div class="alert__message error container">
        <p>
            <?= $_SESSION['edit-post'];
              unset($_SESSION['edit-post']);
              ?>
        </p>
    </div>

    <!-- delete posts is successful -->
    <?php elseif(isset($_SESSION['delete-post-success'])) : ?>
    <div class="alert__message success container">
        <p>
            <?= $_SESSION['delete-post-success'];
              unset($_SESSION['delete-post-success']);
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
                    <a href="index.php" class="active">
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
                    <a href="manage-category.php">
                        <i class="uil uil-list-ul"></i>
                        <h5>Manage Category</h5>
                    </a>
                </li>

                <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Posts</h2>
            <?php if(mysqli_num_rows($posts) > 0) : ?>

            <table>
                <thead>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Update</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                        <!-- get category title of each post from category table -->

                        <?php
                        $category_id = $post['category_id'];
                        $category_query = "SELECT title FROM categories WHERE id = $category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);

                        ?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm success">Update</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                  
                </tbody>
            </table>

            <?php else : ?>
                <div class="alert__message error"><?= "No Posts Found..!" ?></div>

                <?php endif ?>
        </main>
    </div>
</section>

<!-- End category section -->
<?php
include '../partials/footer.php';
?>