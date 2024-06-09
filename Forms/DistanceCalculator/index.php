<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Plano Cartesiano</title>
</head>

<body>
    <?php
    $x1 = 0;
    $y1 = 0;
    $x2 = 0;
    $y2 = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x1 = $_POST["x1"] ?? 0;
        $y1 = $_POST["y1"] ?? 0;
        $x2 = $_POST["x2"] ?? 0;
        $y2 = $_POST["y2"] ?? 0;
    }
    ?>
    <main>
        <h1>Plano Cartesiano</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="number">x1</label>
            <input type="number" name="x1" id="x1" value="<?= $x1 ?>">
            <label for="number">y1</label>
            <input type="number" name="y1" id="y1" value="<?= $y1 ?>">
            <label for="number">x2</label>
            <input type="number" name="x2" id="x2" value="<?= $x2 ?>">
            <label for="number">y2</label>
            <input type="number" name="y2" id="y2" value="<?= $y2 ?>">
            <button type="submit">Calcular a distância entre pontos</button>
        </form>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $distance = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
        $formatted_distance = number_format($distance, 2, ",", "");
        $imperial = number_format($distance / 1609.34, 1, ",", "");
        $km = number_format($distance / 1000, 1, ",", "");

        echo "
            <p>A distância entre os pontos ($x1, $y1) e ($x2, $y2) é:</p>
            <ul>
                <li><strong>$formatted_distance</strong> metros (sistema métrico).</li>
                <li><strong>$km</strong> quilômetros (sistema imperial).</li>
                <li><strong>$imperial</strong> milhas (sistema imperial).</li>
            </ul>
        ";
        ?>
    </section>
</body>

</html>