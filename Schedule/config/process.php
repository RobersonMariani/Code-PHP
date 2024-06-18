<?php

session_start();

include_once("connection.php");
include_once("url.php");

$data = $_POST;

if (!empty($data)) {
    if ($data["type"] === "create") {
        $name  = $data["name"];
        $phone = $data["phone"];
        $email = $data["email"] ?? "";
        $obs   = $data["observations"] ?? "";
        $query = "INSERT INTO contacts (name, phone, email, observations) VALUES (:name, :phone, :email, :observations)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":observations", $obs);

        try {
            $stmt->execute();
            $_SESSION["msg"] = "Contato criado com sucesso!";
            //Setando o modo de erro
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "ERRO: $error";
        }
    } elseif ($data["type"] === "edit") {
        $name  = $data["name"];
        $phone = $data["phone"];
        $email = $data["email"] ?? "";
        $obs   = $data["observations"] ?? "";
        $id    = $data["id"];
        $query = "UPDATE contacts
                  SET name = :name, phone = :phone, email = :email, observations = :observations
                  WHERE id = :id
                 ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":observations", $obs);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            $_SESSION["msg"] = "Contato atualizado com sucesso!";
            //Setando o modo de erro
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "ERRO: $error";
        }
    } elseif ($data["type"] === "delete") {
        $id = $data["id"];
        $query = "DELETE FROM contacts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            $_SESSION["msg"] = "Contato excluido com sucesso!";
            //Setando o modo de erro
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "ERRO: $error";
        }
    }
    header("Location:" . $BASE_URL . "../index.php");
} else {
    $id;
    if (!empty($_GET)) {
        $id = $_GET['id'];
    }

    if (!empty($id)) {
        //Retorna apenas 1 contato
        $query = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        //Retorna todos os contatos
        $contact = [];
        $query = "SELECT * FROM contacts";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$conn = null;
