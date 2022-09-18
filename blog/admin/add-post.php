<?php
include 'partials/header.php';

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get back form data
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

// delete form data session
unset($_SESSION['add-post-data']);
?>

<!-- Add Post Form -->
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Posts</h2>

        <?php if(isset($_SESSION['add-post'])) : ?>

        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-post'];
                unset($_SESSION['add-post']);
                 ?>
            </p>
        </div>

        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" placeholder="Title" name="title" value="<?= $title ?>">
            <select name="category">

            <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" placeholder="Body" name="body"><?= $body ?></textarea>

            <?php if(isset($_SESSION['user_is_admin'])) : ?>

            <div class="form__control inline">
                <input type="checkbox" id="is_feactured" name="is_featured" value="1" checked>
                <label for="is_feactured">Featured</label>
            </div>

            <?php endif ?>

            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>

            <button type="submit" class="btn" name="submit">Create Posts</button>

        </form>
    </div>
</section>

<!-- End Form -->


<!-- Footer -->
<?php
include '../partials/footer.php'
?>