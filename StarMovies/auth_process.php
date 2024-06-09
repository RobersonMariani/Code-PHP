<?php

require_once("db.php");
require_once("globals.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

//Verificar tipo formulário
$type = filter_input(INPUT_POST, "type");

//Verificação do tipo de formulário
if ($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "emailr");
    $password = filter_input(INPUT_POST, "passwordr");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    //Verificação dados minimos
    if ($name && $lastname && $email && $password) {
        if ($password === $confirmpassword) {
            if ($userDao->findByEmail($email) === false) {
                $user = new User();

                $userToken = $user->generateToken();
                $finalPassword = $user->generatePassword($password);

                $user->setName($name);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPassword($finalPassword);
                $user->setToken($userToken);

                $auth = true;

                $userDao->create($user, $auth);
            } else {
                $message->setMessage("Usuário já cadastrado!", "error", "back");
            }
        } else {
            $message->setMessage("As senhas não são iguais", "error", "back");
        }
    } else {
        $message->setMessage("Preencha todos os campos!", "error", "back");
    }
} elseif ($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    if ($userDao->authenticateUser($email, $password)) {
        $message->setMessage("Seja bem-vindo", "success", "index.php");
    } else {
        $message->setMessage("Usuário e/ou senha incorretos !", "error", "back");
    }
} else {
    $message->setMessage("Infromações inválidas!", "error", "index.php");
}
