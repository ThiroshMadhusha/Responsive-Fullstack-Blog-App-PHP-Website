<?php
include 'partials/header.php';

// fetch feactures post from db
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// fetch 9 post from table
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection,$query);
?>

<?php if(mysqli_num_rows($featured_result) == 1) : ?>

<!-- Start Feactures Posts -->
<section class="feactured">
    <div class="container featured__container">
        <div class="post__thumnail_feacture">
            <img src="./images/<?= $featured['thumbnail'] ?>" alt="blog">
        </div>
        <div class="post__info">

        <?php
        $category_id = $featured['category_id'];
        $category_query ="SELECT * FROM categories WHERE id=$category_id";
        $category_result = mysqli_query($connection, $category_query);
        $category = mysqli_fetch_assoc($category_result);
        ?>
            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
            <h2 class="post__title">

                <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>">
                    <?= $featured['title'] ?>
                </a>
            </h2>
            <p class="post__body">
                <?= substr($featured['body'],0 , 450) ?> ...
            </p>
            <div class="post__author">

            <?php
            $author_id = $featured['author_id'];
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
                        <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif ?>
<!-- End of Feactures Post -->

<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
    <div class="container post__container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>

        <article class="post">
            <div class="post__thumnail">
                <img src="./images/<?= $post['thumbnail'] ?>" alt="blog">
            </div>
            <div class="post__info">

            <?php
            $category_id = $post['category_id'];
            $category_query ="SELECT * FROM categories WHERE id=$category_id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            ?>
                <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
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