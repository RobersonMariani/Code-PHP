<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Calcular números</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valueOne = $_POST["numOne"] ?? 0;
        $valueTwo = $_POST["numTwo"] ?? 0;
        $operator = $_POST["calc"] ?? 0;
    }
    ?>
    <main>
        <h1>Calcular números</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="numOne">Primeiro valor</label>
            <input type="number" name="numOne" id="numOne" value="<?= $valueOne ?>" required>
            <label for="numTwo">Segundo valor</label>
            <input type="number" name="numTwo" id="numTwo" value="<?= $valueTwo ?>" required>
            <input type="radio" name="calc" id="sum" value="sum">Somar
            <input type="radio" name="calc" id="sub" value="sub">Subtrair
            <input type="radio" name="calc" id="mult" value="mult">Multiplicar
            <input type="radio" name="calc" id="div" value="div">Dividir
            <button type="submit">Calcular</button>
        </form>
    </main>
    <section id="result">
        <h2>Resultado da operação</h2>
        <?php
        switch ($operator) {
            case 'sum':
                $sum = $valueOne + $valueTwo;
                echo "<p>A soma entre $valueOne e $valueTwo é: <strong>$sum</strong></p>";

                break;
            case 'sub':
                $sub = $valueOne - $valueTwo;
                echo "<p>A Subtração entre $valueOne e $valueTwo é: <strong>$sub</strong></p>";
                break;
            case 'mult':
                $mult = $valueOne * $valueTwo;
                echo "<p>A Multiplicação entre $valueOne e $valueTwo é: <strong>$mult</strong></p>";
                break;
            case 'div':
                if ($valueTwo != 0) {
                    $div = $valueOne / $valueTwo;
                    echo "<p>O resultado da divisão $valueOne por $valueTwo é: <strong>$div</strong></p>";
                } else {
                    echo "Não é possível dividir um número por zero!";
                }
                break;
        }
        ?>
    </section>
</body>

</html>