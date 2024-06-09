<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Anatomia de uma Divisão</title>
</head>

<body>
    <?php
    $dividend = 0;
    $divider = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dividend = $_POST["dividend"] ?? 0;
        $divider = $_POST["divider"] ?? 1;
    }
    ?>
    <main>
        <h1>Anatomia de uma Divisão</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="dividend">Dividendo</label>
            <input type="number" min="0" name="dividend" id="dividend" value="<?= $dividend ?>">
            <label for="divider">Divisor</label>
            <input type="number" min="1" name="divider" id="divider" value="<?= $divider ?>">
            <button type="submit">Analisar</button>
        </form>
    </main>
    <section id="result">
        <h2>Estrutura da Divisão</h2>
        <?php
        $division = $dividend / $divider;
        $rest     = $dividend % $divider;
        echo "
            <table class=\"divisao\">
                <tbody>
                    <tr>
                        <td>$dividend</td>
                        <td>$divider</td>
                    </tr>
                    <tr>
                        <td>$rest</td>
                        <td>$division</td>
                    </tr>
                </tbody>
            </table>
            ";
        ?>
    </section>
</body>

</html>