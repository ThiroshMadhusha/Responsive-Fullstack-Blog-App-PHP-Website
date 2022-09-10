<?php
include 'partials/header.php';

// get back form data is invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

// assigne
unset($_SESSION['add-category-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>

        <?php if(isset($_SESSION['add-category'])) : ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>

        <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" placeholder="Title" name="title" value="<?= $title ?>" />
            <textarea rows="4" placeholder="Description" name="description" value="<?= $description ?>" ></textarea>


            <button type="submit" class="btn" name="submit">Add Category</button>

        </form>
    </div>
</section>


<?php
include '../partials/footer.php'
?>