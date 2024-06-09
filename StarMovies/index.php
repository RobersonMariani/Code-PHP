<?php
require_once("templates/header.php");
require_once("dao/MovieDAO.php");
require_once("config.php"); // Inclua o arquivo de configuração

$movieDao = new MovieDAO($conn, $BASE_URL);

// Verifica se uma categoria foi selecionada, caso contrário, exibe todos os filmes
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

// Obtém os filmes de acordo com a categoria selecionada
if ($selectedCategory === 'all') {
    $movies = $movieDao->getLatestMovies();
} else {
    $movies = $movieDao->getMovieByCategory($selectedCategory);
}
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no StarMovies</p>

    <!-- Links de navegação por categorias -->
    <div class="nav-categories">
        <a href="?category=all" class="<?= $selectedCategory === 'all' ? 'active' : '' ?>">Todos</a>
        <?php foreach (CATEGORIES as $index => $category) : ?>
            <a href="?category=<?= $index ?>" class="<?= $selectedCategory === $index ? 'active' : '' ?>"><?= $category ?></a>
        <?php endforeach; ?>
    </div>

    <div class="movies-container">
        <?php if (count($movies) > 0) : ?>
            <?php foreach ($movies as $movie) : ?>
                <?php require("templates/movie_card.php") ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        <?php endif; ?>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>