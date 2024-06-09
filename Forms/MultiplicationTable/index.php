<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Calculando a Tabuada</title>
</head>

<body>
    <?php
    $number = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number    = $_POST["number"] ?? 0;
    }
    ?>
    <main>
        <h1>Calculando a Tabuada</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="number">Digite um número</label>
            <input type="number" name="number" id="number" value="<?= $number ?>">
            <button type="submit">Calcular</button>
        </form>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $result = 0;
        echo "
                <p>Analisando o número digitado...</p>
                <p>A tabuada de <strong>$number</strong> é:</p>
                <ul>
            ";
        for ($i = 0; $i <= 10; $i++) {
            $result = $number * $i;
            echo "
                    <li><strong>$number x $i = $result</strong></li>
                ";
        }
        echo "
                </ul>
            ";
        ?>
    </section>
</body>

</html>