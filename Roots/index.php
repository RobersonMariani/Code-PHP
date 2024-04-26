<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Raizes</title>
</head>

<body>
    <?php
    $number = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST["number"] ?? 0;
    }
    ?>
    <main>
        <h1>Raiz quadrada e Raiz cúbica</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="number">Digite um número</label>
            <input type="number" id="number" name="number" value="<?= $number ?>">
            <button type="submit">Calcular</button>
        </form>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $squareRoot = number_format(sqrt($number), 3, ",", ".");
        $cubicRoot = number_format(pow($number, 1 / 3), 3, ",", ".");
        echo "
        <p>Analisando o <strong>número $number,</strong> temos:</p>
        <ul>
            <li>A sua Raiz quadrada é <strong>$squareRoot</strong></li>
            <li>A sua Raiz cúbica é <strong>$cubicRoot</strong></li>
        </ul>
        ";
        ?>
    </section>
</body>

</html>