<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>
    <?php
    $second = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $second    = $_POST["second"] ?? 0;
    }
    ?>
    <main>
        <h1>Calculadora de Tempo</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="second">Digite o tempo em segundos</label>
            <input type="number" name="second" id="second" value="<?= $second ?>">
            <button type="submit">Converter</button>
        </form>withdraw
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $year    = floor($second / (60 * 60 * 24 * 365));
        $week    = floor(($second % (60 * 60 * 24 * 365)) / (60 * 60 * 24 * 7));
        $day     = floor(($second % (60 * 60 * 24 * 7)) / (60 * 60 * 24));
        $hour    = floor(($second % (60 * 60 * 24)) / (60 * 60));
        $minute  = floor(($second % (60 * 60)) / 60);
        $seconds = $second % 60;
        echo "
                <p>Analisando o valor digitado, <strong>" . number_format($second, 0, ".", ".") . " segundos</strong> equivalem a um total de:
                </p>
                <ul>
                    <li>$year anos</li>
                    <li>$week semanas</li>
                    <li>$day dias</li>
                    <li>$hour horas</li>
                    <li>$minute minutos</li>
                    <li>$seconds segundos</li>
                </ul>
            ";
        ?>
    </section>
</body>

</html>