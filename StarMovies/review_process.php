<?php
require_once("db.php");
require_once("globals.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("models/Review.php");
require_once("dao/MovieDAO.php");
require_once("dao/UserDAO.php");
require_once("dao/ReviewDAO.php");

$message = new Message($BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);

//Verificar tipo formulário
$type = filter_input(INPUT_POST, "type");

//Resgata dados do usuário
$userData = $userDao->verifyToken();

if ($type === "create") {
    $rating   = filter_input(INPUT_POST, "rating");
    $review   = filter_input(INPUT_POST, "review");
    $movie_id = filter_input(INPUT_POST, "movie_id");

    $reviewObj = new Review();

    $movieData = $movieDao->findById($movie_id);

    if ($movieData) {
        if (!empty($rating) && !empty($review) && !empty($movie_id)) {
            $reviewObj->setRating($rating);
            $reviewObj->setReview($review);
            $reviewObj->setMovie_id($movie_id);
            $reviewObj->setUser_id($userData->getId());

            $reviewDao->create($reviewObj);
        } else {
            $message->setMessage("Você precisa inseria a nota e o comentário", "error", "back");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
