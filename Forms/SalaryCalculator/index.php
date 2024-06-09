<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Calcular Salário</title>
</head>

<body>
    <?php
    $salary = 0;
    $basicSalary = 1_412; // valor do salário minimo
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $salary = $_POST["salary"] ?? $basicSalary;
    }
    $formatDefault = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
    ?>
    <main>
        <h1>Informe seu salário</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="salary">Salário (R$)</label>
            <input type="number" name="salary" id="salary" value="<?= $salary ?>">
            <button type="submit">Calcular</button>
        </form>
        <p>*Considerando o salário mínimo atual de <strong> R$<?= number_format($basicSalary, 2, ",", ".") ?></strong></p>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $qtdSalary   = bcdiv($salary, $basicSalary, 0);
        $restSalary  = $salary % $basicSalary;

        if ($salary) {
            echo "
                    <p>Quem recebe um salário de " . numfmt_format_currency($formatDefault, $salary, "BRL") . " ganha <strong>$qtdSalary salários mínimos +</strong> " . numfmt_format_currency($formatDefault, $restSalary, "BRL") . "</p>
                ";
        }
        ?>
    </section>
</body>

</html>