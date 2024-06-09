<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Validação de E-mail</title>
</head>

<body>
    <?php
    $email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email    = $_POST["email"] ?? "Não informado";
    }
    ?>
    <main>
        <h1>Validação de E-mail</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="email">Digite seu E-mail</label>
            <input type="email" name="email" id="email" value="<?= $email ?>">
            <button type="submit">Validar</button>
        </form>
    </main>
    <section>
        <h2>Aguardando...</h2>
        <?php
        if ($email) {
            echo "<p>Verificando E-mail...</p>";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<strong style=\"color:red;\">E-mail $email não é válido!</strong>";
            } else {
                echo "<strong style=\"color:green;\">E-mail $email validado com sucesso!</strong>";
            }
        }
        ?>
    </section>
</body>

</html>