<?php
include_once("templates/header.php");

if (isset($_GET["id"])) {
    $postId = $_GET["id"];
    $currentPost;

    foreach ($posts as $post) {
        if ($post["id"] == $postId) {
            $currentPost = $post;
        }
    }
}
?>

<main id="post-container">
    <div class="content-container">
        <h1 id="main-title"><?= $currentPost["title"] ?></h1>
        <p class="post-description"><?= $currentPost["description"] ?></p>
        <div class="img-container">
            <img src="<?= $BASE_URL ?>/img/<?= $currentPost["img"] ?>" alt="<?= $currentPost["title"] ?>">
        </div>
        <p class="post-content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non aliquid minus veniam doloribus reiciendis adipisci dolorum quia facere, voluptates illo ad dicta ab ipsum eius! Sint a molestiae corrupti totam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non aliquid minus veniam doloribus reiciendis adipisci dolorum quia facere, voluptates illo ad dicta ab ipsum eius! Sint a molestiae corrupti totam.
        </p>
        <p class="post-content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non aliquid minus veniam doloribus reiciendis adipisci dolorum quia facere, voluptates illo ad dicta ab ipsum eius! Sint a molestiae corrupti totam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non aliquid minus veniam doloribus reiciendis adipisci dolorum quia facere, voluptates illo ad dicta ab ipsum eius! Sint a molestiae corrupti totam.
        </p>
    </div>
    <aside id="nav-container">
        <h3 class="tags-title">Tags</h3>
        <ul class="tag-list">
            <?php foreach ($currentPost["tags"] as $tag) : ?>
                <li><a href="#"><?= $tag ?></a></li>
            <?php endforeach; ?>
        </ul>
        <h3 class="categories-title">Categorias</h3>
        <ul class="categories-list">
            <?php foreach ($categories as $category) : ?>
                <li><a href="#"><?= $category ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</main>
<?php
include_once("templates/footer.php")
?>