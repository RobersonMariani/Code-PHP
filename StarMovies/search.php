<?php
require_once("templates/header.php");
require_once("dao/MovieDAO.php");

$movieDao = new MovieDAO($conn, $BASE_URL);

$q = filter_input(INPUT_GET, "q");

$movies = $movieDao->findByTitle($q);
?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title">Você está busanco por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de busca retornados com base na sua pesquisa</p>
    <div class="movies-container">
        <?php foreach ($movies as $movie) : ?>
            <?php require("templates/movie_card.php") ?>
        <?php endforeach; ?>
        <?php if (count($movies) === 0 || $movie === null) : ?>
            <p class="empty-list">Não há filmes para está busca, <a class="back-link" href="<?= $BASE_URL ?>">voltar</a>.</p>
        <?php endif; ?>
    </div>
</div>

<?php
require_once("templates/footer.php")
?>