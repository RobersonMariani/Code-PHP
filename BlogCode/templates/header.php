<?php
include_once("helpers/url.php");
include_once("data/posts.php");
include_once("data/categories.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Blog Codar</title>
</head>

<body>
    <header>
        <a href="<?= $BASE_URL ?>" id="logo">
            <img src="<?= $BASE_URL ?>/img/logo.svg" alt="Blog Codar">
        </a>
        <nav>
            <ul id="navbar">
                <li><a class="nav-link" href="<?= $BASE_URL ?>">Home</a></li>
                <li><a class="nav-link" href="<?= $BASE_URL ?>">Categorias</a></li>
                <li><a class="nav-link" href="<?= $BASE_URL ?>">Sobre</a></li>
                <li><a class="nav-link" href="<?= $BASE_URL ?>/contact.php">Contato</a></li>
            </ul>
        </nav>
    </header>