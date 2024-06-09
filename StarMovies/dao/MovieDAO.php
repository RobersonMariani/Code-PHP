<?php

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/ReviewDAO.php");

class MovieDAO implements MovieDAOInterface
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

    public function buildMovie($data)
    {
        $movie = new Movie();

        $movie->setId($data["id"]);
        $movie->setCategory($data["category"]);
        $movie->setDescription($data["description"]);
        $movie->setImage($data["image"]);
        $movie->setLength($data["length"]);
        $movie->setUser_id($data["user_id"]);
        $movie->setTitle($data["title"]);
        $movie->setTrailer($data["trailer"]);

        $reviewDao = new ReviewDAO($this->conn, $this->url);
        $rating = $reviewDao->getRatingAverage($movie->getId());

        $movie->rating = $rating;

        return $movie;
    }

    public function findAll()
    {
        $movies = [];

        $stmt = $this->conn->query("SELECT * FROM movies ORDER BY category");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $moviesArray = $stmt->fetchAll();
            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }

    public function getLatestMovies()
    {
        $movies = [];

        $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $moviesArray = $stmt->fetchAll();
            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }

    public function getMovieByCategory($category)
    {
        $movies = [];

        $stmt = $this->conn->prepare("SELECT * FROM movies
                                      WHERE category = :category
                                      ORDER BY id DESC");
        $stmt->bindParam(":category", $category);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $moviesArray = $stmt->fetchAll();
            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }

    public function getMovieByUserId($id)
    {
        $movies = [];

        $stmt = $this->conn->prepare("SELECT * FROM movies
                                      WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $moviesArray = $stmt->fetchAll();
            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }

    public function findById($id)
    {
        $movie = [];

        $stmt = $this->conn->prepare("SELECT * FROM movies
                                      WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $movieData = $stmt->fetch();
            $movie = $this->buildMovie($movieData);

            return $movie;
        } else {
            return false;
        }
    }

    public function findByTitle($title)
    {
        $movies = [];
        $title = "%" . $title . "%";
        $stmt = $this->conn->prepare("SELECT * FROM movies
                                      WHERE title LIKE :title");
        $stmt->bindParam(":title", $title);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $moviesArray = $stmt->fetchAll();
            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }

    public function create(Movie $movie)
    {
        $title       = $movie->getTitle();
        $description = $movie->getDescription();
        $image       = $movie->getImage();
        $trailer     = $movie->getTrailer();
        $category    = $movie->getCategory();
        $length      = $movie->getLength();
        $user_id     = $movie->getUser_id();

        $stmt = $this->conn->prepare("INSERT INTO movies (
            title,
            description,
            image,
            trailer,
            category,
            length,
            user_id
        ) VALUES(
         :title, :description, :image, :trailer, :category, :length, :user_id
        )");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":trailer", $trailer);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();

        $this->message->setMessage("Filme adicionado com sucesso!", "success", "index.php");
    }

    public function update(Movie $movie)
    {
        $title       = $movie->getTitle();
        $description = $movie->getDescription();
        $image       = $movie->getImage();
        $trailer     = $movie->getTrailer();
        $category    = $movie->getCategory();
        $length      = $movie->getLength();
        $id          = $movie->getId();

        $stmt = $this->conn->prepare("UPDATE movies SET
            title       = :title,
            description = :description,
            image       = :image,
            category    = :category,
            trailer     = :trailer,
            length      = :length
            WHERE id    = :id
        ");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":trailer", $trailer);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $this->message->setMessage("Filme editado com sucesso!", "success", "dashboard.php");
    }

    public function destroy($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $this->message->setMessage("Filme deletado com sucesso!", "success", "dashboard.php");
    }
}
