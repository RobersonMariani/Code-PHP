<?php

$host = "localhost";
$dbname = "schedule";
$user = "root";
$pass = "";

try {
    //Conexão
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    //Setando o modo de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo "ERRO: $error";
}
