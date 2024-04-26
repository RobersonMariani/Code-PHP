<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Média Aritmética</title>
</head>

<body>
    <?php
    $firstNote    = 0;
    $firstWeight  = 1;
    $secondNote   = 0;
    $secondWeight = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstNote    = $_POST["firstNote"] ?? 0;
        $firstWeight  = $_POST["firstWeight"] ?? 1;
        $secondNote   = $_POST["secondNote"] ?? 0;
        $secondWeight = $_POST["secondWeight"] ?? 1;
    }
    ?>
    <main>
        <h1>Média Aritmética</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="firstNote">1º Nota</label>
            <input type="number" id="firstNote" name="firstNote" value="<?= $firstNote ?>" required>
            <label for="firstWeight">1º Peso</label>
            <input type="number" id="firstWeight" name="firstWeight" value="<?= $firstWeight ?>">
            <label for="secondNote">2º Nota</label>
            <input type="number" id="secondNote" name="secondNote" value="<?= $secondNote ?>" required>
            <label for="secondWeight">2º Peso</label>
            <input type="number" id="secondWeight" name="secondWeight" value="<?= $secondWeight ?>">
            <button type="submit">Calcular</button>
        </form>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $simpleAverage   = bcdiv(($firstNote + $secondNote), 2, 2);
        $weightedAverage = bcdiv(
            bcadd(
                bcmul($firstNote, $firstWeight),
                bcmul($secondNote, $secondWeight)
            ),
            bcadd(
                $firstWeight,
                $secondWeight
            ),
            2
        );
        echo "
                <p>Analisando os valores $firstNote e $secondNote</p>

                <ul>
                    <li>A <strong>Média Aritmética Simples</strong> entre os valores é igual a $simpleAverage.</li>
                    <li>A <strong>Média Aritmética Ponderada</strong> entre os valores é igual a $weightedAverage.</li>
                </ul>
            ";
        ?>
    </section>
</body>

</html>