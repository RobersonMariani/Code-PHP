<?php
require_once("db.php");
require_once("globals.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/MovieDAO.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

//Verificar tipo formulário
$type = filter_input(INPUT_POST, "type");

//Resgata dados do usuário
$userData = $userDao->verifyToken();

if ($type === "create") {
    $title       = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer     = filter_input(INPUT_POST, "trailer");
    $category    = filter_input(INPUT_POST, "category");
    $length      = filter_input(INPUT_POST, "length");
    $user_id     = $userData->getId();

    $movie       = new Movie();

    if (!empty($title) && !empty($description) && !empty($category)) {
        $movie->setTitle($title);
        $movie->setDescription($description);
        $movie->setCategory($category);
        $movie->setLength($length);
        $movie->setUser_id($user_id);
        $movie->setTrailer($trailer);

        //Upload de imagem para o filme
        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
            $image      = $_FILES["image"];
            $imageTypes = ["image/jpg", "image/jpeg", "image/png"];
            $jpgArray   = ["image/jpg", "image/jpeg"];

            // Checado tipo da imagem
            if (in_array($image["type"], $imageTypes)) {
                //Checar se jpg
                if (in_array($image["type"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    //Checar se png
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $imageName = $movie->generateImageName();

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->setImage($imageName);
            } else {
                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
            }
        }

        $movieDao->create($movie);
    } else {
        $message->setMessage("Os campos <strong>título</strong>, <strong>descrição</strong> e <strong>categoria</strong> devem ser preenchidos", "error", "back");
    }
} elseif ($type === "delete") {
    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDao->findById($id);
    if ($movie) {
        if ($movie->getUser_id() === $userData->getId()) {
            $movieDao->destroy($movie->getId());
        } else {
            $message->setMessage("Informações inválidas!", "error", "index.php");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} elseif ($type === "update") {
    $title       = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer     = filter_input(INPUT_POST, "trailer");
    $category    = filter_input(INPUT_POST, "category");
    $length      = filter_input(INPUT_POST, "length");
    $id          = filter_input(INPUT_POST, "id");
    $user_id     = $userData->getId();

    $movieData = $movieDao->findById($id);

    if ($movieData) {
        if (!empty($title) && !empty($description) && !empty($category)) {
            if ($movieData->getUser_id() === $userData->getId()) {
                $movieData->setTitle($title);
                $movieData->setDescription($description);
                $movieData->setTrailer($trailer);
                $movieData->setCategory($category);
                $movieData->setLength($length);

                //Upload de imagem para o filme
                if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
                    $image      = $_FILES["image"];
                    $imageTypes = ["image/jpg", "image/jpeg", "image/png"];
                    $jpgArray   = ["image/jpg", "image/jpeg"];

                    // Checado tipo da imagem
                    if (in_array($image["type"], $imageTypes)) {
                        //Checar se jpg
                        if (in_array($image["type"], $jpgArray)) {
                            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                        } else {
                            //Checar se png
                            $imageFile = imagecreatefrompng($image["tmp_name"]);
                        }

                        $imageName = $movieData->generateImageName();

                        imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                        $movieData->setImage($imageName);
                    } else {
                        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
                    }
                }

                $movieDao->update($movieData);
            } else {
                $message->setMessage("Informações inválidas!", "error", "index.php");
            }
        } else {
            $message->setMessage("Os campos <strong>título</strong>, <strong>descrição</strong> e <strong>categoria</strong> devem ser preenchidos", "error", "back");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
