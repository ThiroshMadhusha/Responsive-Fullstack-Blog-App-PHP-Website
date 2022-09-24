<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);

}else{
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>
<!-- End Nav Bar -->

<!-- Start Category -->

<header class="category__title">
    <h2>
            <?php
            $category_id = $id;
            $category_query ="SELECT * FROM categories WHERE id=$id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            echo $category['title']
        
            ?>
    </h2>
</header>
<!-- End Category -->

<?php if(mysqli_num_rows($posts) > 0) : ?>

<section class="posts">
    <div class="container post__container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>

        <article class="post">
            <div class="post__thumnail">
                <img src="./images/<?= $post['thumbnail'] ?>" alt="blog">
            </div>
            <div class="post__info">
                <h3 class="post__title">
                    <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                        <?= $post['title'] ?>
                    </a>
                </h3>

                <!-- Single post Read More Sectioon -->
                <p class="post__body">
                    <?= substr($post['body'],0 , 150) ?> 
                    <br/>
                    <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                        Read More...
                    </a>
                </p>
                <div class="post__author">
                    <?php
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);

                    ?>
                    <div class="post__author-avatar">
                        <img src="./images/<?= $author['avatar'] ?>" alt="avatar">
                    </div>
                    <div class="post__author-info">
                        <h5>Post By : <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </article>
        <?php endwhile ?>
    </div>
</section>

<?php else : ?>
    <div class="alert__message error lg">
        <p>
            No Post Found For This Category..!
        </p>
    </div>
    <?php endif ?>


<!-- End of Feactures -->


<!-- Category Section -->
<section class="category__buttons">
    <div class="container category__buttons-container">

    <?php 
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
    ?>

    <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
        <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
    <?php endwhile ?>
    </div>
</section>

<!-- End category section -->

<?php
include 'partials/footer.php';
?>