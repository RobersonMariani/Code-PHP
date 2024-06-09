<?php

require_once("models/Review.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");


class ReviewDAO implements ReviewDAOInterface
{
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildReview($data)
    {
        $reviewObj = new Review();

        $reviewObj->setId($data["id"]);
        $reviewObj->setRating($data["rating"]);
        $reviewObj->setReview($data["review"]);
        $reviewObj->setUser_id($data["user_id"]);
        $reviewObj->setMovie_id($data["movie_id"]);

        return $reviewObj;
    }
    public function create(Review $review)
    {
        $rating   = $review->getRating();
        $reviews  = $review->getReview();
        $user_id  = $review->getUser_id();
        $movie_id = $review->getMovie_id();

        $stmt = $this->conn->prepare("INSERT INTO reviews (
            rating,
            review,
            user_id,
            movie_id
        ) VALUES(
         :rating, :review, :user_id, :movie_id
        )");
        $stmt->bindParam(":rating", $rating);
        $stmt->bindParam(":review", $reviews);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":movie_id", $movie_id);

        $stmt->execute();

        $this->message->setMessage("Avaliação adicionada com sucesso!", "success", "back");
    }
    public function getMoviesReview($id)
    {
        $reviews = [];

        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movie_id = :movie_id");
        $stmt->bindParam("movie_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reviewsArray = $stmt->fetchAll();
            $userDao = new UserDAO($this->conn, $this->url);
            foreach ($reviewsArray as $review) {
                $reviewObj = $this->buildReview($review);

                $user = $userDao->findById($reviewObj->getUser_id());

                $reviewObj->user = $user;

                $reviews[] = $reviewObj;
            }
        }

        return $reviews;
    }
    public function hasAlreadyReviewed($id, $user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movie_id = :movie_id AND user_id = :user_id");
        $stmt->bindParam(":movie_id", $id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getRatingAverage($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movie_id = :movie_id");
        $stmt->bindParam(":movie_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $rating = 0;
            $reviews = $stmt->fetchAll();

            foreach ($reviews as $review) {
                $rating += $review["rating"];
            }

            $rating = bcdiv($rating,count($reviews), 1);
            return  $rating;
        } else {
            $rating = "Não avaliado";
            return $rating;
        }
    }
}
