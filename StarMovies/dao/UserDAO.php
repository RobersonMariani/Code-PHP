<?php

require_once("models/User.php");
require_once("models/Message.php");

class UserDAO implements UserDAOInterface
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

    public function buildUser($data)
    {
        $user = new User();

        $user->setId($data["id"]);
        $user->setName($data["name"]);
        $user->setLastname($data["lastname"]);
        $user->setEmail($data["email"]);
        $user->setPassword($data["password"]);
        $user->setImage($data["image"]);
        $user->setBio($data["bio"]);
        $user->setToken($data["token"]);

        return $user;
    }

    public function create(User $user, $authUser = false)
    {
        $stmt = $this->conn->prepare("INSERT INTO users(
            name, lastname, email, password, token
            ) VALUES (
            :name, :lastname, :email, :password, :token
            )");
        $stmt->bindValue(":name", $user->getName());
        $stmt->bindValue(":lastname", $user->getLastname());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->bindValue(":token", $user->getToken());
        $stmt->execute();

        if ($authUser) {
            $this->setTokenToSession($user->getToken(), $user->getName() . " " . $user->getLastname());
        }
    }

    public function update(User $user, $redirect = true)
    {
        $stmt = $this->conn->prepare("UPDATE users SET
            name     = :name,
            lastname = :lastname,
            email    = :email,
            image    = :image,
            bio      = :bio,
            token    = :token
            WHERE id = :id
        ");
        $stmt->bindValue(":name", $user->getName());
        $stmt->bindValue(":lastname", $user->getLastname());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":image", $user->getImage());
        $stmt->bindValue(":bio", $user->getBio());
        $stmt->bindValue(":token", $user->getToken());
        $stmt->bindValue(":id", $user->getId());
        $stmt->execute();

        if ($redirect) {
            $this->message->setMessage("Dados atualizados com sucesso", "success", "editprofile.php");
        }
    }

    public function verifyToken($protected = false)
    {
        if (!empty($_SESSION["token"])) {
            $token = $_SESSION["token"];

            $user = $this->findByToken($token);
            if ($user) {
                return $user;
            } else if ($protected) {
                $this->message->setMessage("Faça a sua autenticação para acessar a página", "error", "index.php");
            }
        } else if ($protected) {
            $this->message->setMessage("Faça a sua autenticação para acessar a página", "error", "index.php");
        }
    }

    public function setTokenToSession($token, $name, $redirect = true)
    {
        $_SESSION["token"] = $token;

        if ($redirect) {
            $this->message->setMessage("Seja bem-vindo $name", "success", "editprofile.php");
        }
    }

    public function authenticateUser($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user) {
            if (password_verify($password, $user->getPassword())) {
                $token = $user->generateToken();
                $this->setTokenToSession($token, $user->getName() . " " . $user->getLastname(), false);

                $user->setToken($token);
                $this->update($user, false);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findByEmail($email)
    {
        if ($email != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->buildUser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findById($id)
    {
        if ($id != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->buildUser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findByToken($token)
    {
        if ($token != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token", $token);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->buildUser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function destroyToken()
    {
        unset($_SESSION["token"]);

        $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");
    }

    public function chancePassword(User $user)
    {
        $password = $user->getPassword();
        $id       = $user->getId();

        $stmt = $this->conn->prepare("UPDATE users SET
            password = :password
            WHERE id = :id
        ");
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $this->message->setMessage("Senha alterada com sucesso!", "success", "editprofile.php");
    }
}
