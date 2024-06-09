<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Reajustador de preço</title>
</head>

<body>
    <?php
    $price = 0;
    $percentage = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $price = $_POST["price"] ?? 0;
        $percentage = $_POST["percentage"] ?? 0;
    }
    $formatDefault = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
    ?>
    <main>
        <h1>Reajustador de Preço</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="price">Preço do Produto (R$)</label>
            <input type="number" step="0.01" name="price" id="price" value="<?= $price ?>">
            <label for="percentage">Qual será o percentual de reajuste? (<strong><span id="percent"><?= "$percentage%" ?></span></strong>)</label>
            <input type="range" min="0" max="100" value="<?= $percentage ?>" name="percentage" id="percentage">
            <button type="submit">Reajustar</button>
        </form>
    </main>
    <section>
        <h2>Preço Reajustado</h2>
        <?php
        $newPrice =  $price + ($price * $percentage / 100);
        echo "
                <p>O produto que custava " . numfmt_format_currency($formatDefault, $price, "BRL") . " com <strong>$percentage% de aumento</strong> vai passar a custar <strong>" . numfmt_format_currency($formatDefault, $newPrice, "BRL") . "</strong> a partir de agora.
                </p>
            ";
        ?>
    </section>
    <script>
        const rangeInput = document.querySelector("#percentage");
        const rangeValue = document.querySelector("#percent");

        rangeInput.addEventListener('input', function() {
            rangeValue.textContent = `${this.value}%`;
        });
    </script>
</body>

</html>