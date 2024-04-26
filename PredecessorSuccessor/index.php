<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Resultado</h1>
    </header>

    <main>
        <?php
        $number = $_POST["number"] ?? 0;
        $antNumber = $number - 1;
        $sucNumber = $number + 1;
        echo <<<CONTENT
                <p>O número escolhido foi <strong>$number</strong>.</p>
                <p>O seu antecessor é <strong>$antNumber</strong></p>
                <p>O seu sucessor é <strong>$sucNumber</strong></p>
            CONTENT;
        ?>
        <button onclick="javascript:location.reload()">Voltar</button>
    </main>
</body>

</html>