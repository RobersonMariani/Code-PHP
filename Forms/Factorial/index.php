<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fatorial de um Número</title>
</head>

<body>
    <?php
    $number = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number    = $_POST["number"] ?? 1;
    }
    ?>
    <main>
        <h1>Fatorial de um Número</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="number">Digite um número</label>
            <input type="number" name="number" id="number" value="<?= $number ?>">
            <button type="submit">Calcular Fatorial</button>
        </form>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        if ($number === 1) {
            echo "<p>O fatorial de $number é 1 </p>";
        } else {
            $fat = 1;
            for ($i = 1; $i <= $number; $i++) {
                $fat *= $i;
            }
            echo "<p>O fatorial de $number é " . number_format($fat, 0, ",", ".") . "</p>";
        }
        ?>
    </section>
</body>

</html>