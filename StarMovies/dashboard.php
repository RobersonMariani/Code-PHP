<?php
require_once("templates/header.php");
require_once("dao/MovieDAO.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$message  = new Message($BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);
$userDao  = new UserDAO($conn, $BASE_URL);

$userData  = $userDao->verifyToken(true);
$userMovie = $movieDao->getMovieByUserId($userData->getId());

?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você adicionou</p>
    <div class="col-md-12" id="add-movie-container">
        <a href="<?= $BASE_URL ?>newmovie.php" class="btn form-btn">
            <i class="fas fa-plus"></i> Adicionar Filme
        </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
        <table class="table">
            <thead>
                <tr scope="row">
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Nota</th>
                    <th scope="col" class="actions-column">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userMovie as $movie) : ?>
                    <tr scope="row">
                        <td scope="row"><?= $movie->getId() ?></td>
                        <td><a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->getId() ?>" class="table-movie-title"><?= $movie->getTitle() ?></a></td>
                        <td><i class="fas fa-star"></i> <?= $movie->rating ?></td>
                        <td class="actions-column">
                            <a href="<?= $BASE_URL ?>editmovie.php?id=<?= $movie->getId() ?>" class="edit-btn">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                            <form class="delete-form" action="<?= $BASE_URL ?>movie_process.php" method="POST">
                                <button type="submit" class="delete-btn">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $movie->getId() ?>">
                                    <i class="fas fa-times delete-icon"></i> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once("templates/footer.php")
?>