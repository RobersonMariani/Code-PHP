<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Contando Palavras</title>
</head>

<body>
    <?php
    $word = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $word    = $_POST["word"] ?? 0;
    }
    ?>
    <main>
        <h1>Contando Palavras</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="word">Escreva o texto para ser analisado</label>
            <textarea name="word" id="word" cols="30" rows="10"><?= $word ?></textarea>
            <button type="submit">Verificar</button>
        </form>
    </main>
    <section>
        <h2>Resultado da Análise</h2>
        <?php
        echo "
            <p>O texto analisado é composto por:</p>
            <ul>
                <li>" . strlen(str_replace(" ", "", $word)) . " caracteres</li>
                <li>" . substr_count($word, " ") . " espaços em branco</li>
                <li>" . str_word_count($word) . " palavras</li>
            </ul>
        ";
        ?>
    </section>
</body>

</html>