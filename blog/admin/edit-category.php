<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch data form db
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_assoc($result);
    }

}else{
    header('location: ' . ROOT_URL . 'admin/manage-category');
    die();
}
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>

        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
            <input type="hidden" value="<?= $category['id'] ?>" name="id" />
            <input type="text" placeholder="Title" value="<?= $category['title'] ?>" name="title" />

            <textarea rows="4" placeholder="Description" name="description"><?= $category['description'] ?></textarea>


            <button type="submit" class="btn" name="submit">Update Category</button>

        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>