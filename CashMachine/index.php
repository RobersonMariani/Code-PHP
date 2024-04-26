<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Caixa Eletrônico</title>
</head>

<body>
    <?php
    $withdraw = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $withdraw    = $_POST["withdraw"] ?? 0;
    }
    $formatDefault = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
    ?>
    <main>
        <h1>Caixa Eletrônico</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="withdraw">Qual valor você deseja sacar? (R$)*</label>
            <input type="number" min="5" step="5" name="withdraw" id="withdraw" value="<?= $withdraw ?>">
            <h6>*Notas disponíveis: R$100, R$50, R$10, R$5</h6>
            <button type="submit">Sacar</button>
        </form>
    </main>
    <section>
        <h2>Saque de <?= numfmt_format_currency($formatDefault, $withdraw, "BRL") ?> realizado</h2>
        <?php
        $rest    = $withdraw;
        $note100 = floor($rest / 100);
        $rest   %= 100;
        $note50  = floor($rest / 50);
        $rest   %= 50;
        $note10  = floor($rest / 10);
        $rest   %= 10;
        $note5   = floor($rest / 5);

        echo "
            <ul>
                <li><img src=\"100-reais.jpg\">x$note100</li>
                <li><img src=\"50-reais.jpg\">x$note50</li>
                <li><img src=\"10-reais.jpg\">x$note10</li>
                <li><img src=\"5-reais.jpg\">x$note5</li>
            </ul>
        ";
        ?>
    </section>
</body>

</html>