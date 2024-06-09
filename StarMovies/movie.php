<?php
require_once("templates/header.php");
require_once("dao/MovieDAO.php");
require_once("dao/ReviewDAO.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);

$id = filter_input(INPUT_GET, "id");

$movie = "";

if (empty($id)) {
    $message->setMessage("O filme não foi encontrado!", "error", "index.php");
} else {
    $movie = $movieDao->findById($id);
    if (!$movie) {
        $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    }
}

if ($movie->getImage() == "") {
    $movie->setImage("movie_cover.jpg");
}

$userOwnsMovie = false;
if (!empty($userData)) {
    if ($userData->getId() === $movie->getUser_id()) {
        $userOwnsMovie = true;
    }
    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->getId());
}

$categories = [
    "action"         => "Ação",
    "adventure"      => "Aventura",
    "comedy"         => "Comédia",
    "dance"          => "Dança",
    "documentary"    => "Documentário",
    "drama"          => "Drama",
    "western"        => "Faroeste",
    "fantasy"        => "Fantasia",
    "sciencefiction" => "Ficção científica",
    "war"            => "Guerra",
    "musical"        => "Musical",
    "romance"        => "Romance",
    "thriller"       => "Suspense",
    "horror"         => "Terror",
];

$movieCategory = $movie->getCategory();
$categoryInPortuguese = array_key_exists($movieCategory, $categories) ? $categories[$movieCategory] : ucfirst($movieCategory);

$movieReviews = $reviewDao->getMoviesReview($id);

?>
<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title"><?= $movie->getTitle() ?></h1>
            <p class="movie-details">
                <span>Duração: <?= $movie->getLength() ?></span>
                <span class="pipe"></span>
                <span><?= $categoryInPortuguese ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"> <?= $movie->rating ?></i></span>
            </p>
            <iframe width="560" height="315" src="<?= $movie->getTrailer() ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p><?= $movie->getDescription() ?></p>
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image:url('<?= $BASE_URL ?>img/movies/<?= $movie->getImage() ?>')"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações:</h3>
            <?php if (!empty($userData) && !$userOwnsMovie && !$alreadyReviewed) : ?>
                <div class="col-md-12" id="review-form-container">
                    <h4>Envie sua avaliação:</h4>
                    <p class="page-description">Preencha o formulário com a nota e comentário sobre o filme</p>
                    <form action="<?= $BASE_URL ?>review_process.php" method="POST" id="review-form">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="movie_id" value="<?= $movie->getId() ?>">
                        <div class="form-group">
                            <label for="rating">Nota</label>
                            <select name="rating" id="rating" class="form-control">
                                <option value="">Selecione</option>
                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="review">Seu cometário</label>
                            <textarea class="form-control" name="review" id="review" rows="3" placeholder="O que você achou do filme?"></textarea>
                        </div>
                        <input type="submit" class="btn form-btn" value="Enviar avaliação">
                    </form>
                </div>
            <?php endif; ?>
            <?php foreach ($movieReviews as $review) : ?>
                <?php require("templates/user_review.php") ?>
            <?php endforeach ?>
            <?php if (count($movieReviews) == 0) : ?>
                <p class="empty-list">Não há comentários para este filme ainda</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
require_once("templates/footer.php")
?>