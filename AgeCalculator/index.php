<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Calculando a Idade</title>
</head>

<body>
    <?php
    $birthYear   = 0;
    $currentDate = date("Y");
    $year = $currentDate;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $birthYear = $_POST["birthYear"] ?? 0;
        $year = $_POST["year"] ?? $currentDate;
    }
    ?>
    <main>
        <h1>Calcule sua idade</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="birthYear">Em que ano você nasceu?</label>
            <input type="number" name="birthYear" id="birthYear" value="<?= $birthYear ?>" required>
            <label for="year">Quer saber sua idade em que ano? (atualmente estamos em <strong><?= $currentDate ?></strong>)</label>
            <input type="number" name="year" id="year" value="<?= $year ?>">
            <button type="submit">Ver a sua idade</button>
        </form>
    </main>
    <section>
        <h2>Resultado</h2>
        <?php
        $age = $currentDate - $birthYear;
        echo "
            <p>Quem nasceu em $birthYear vai ter <strong>$age anos</strong> em $currentDate.</p>
          ";
        ?>
    </section>
</body>

</html>