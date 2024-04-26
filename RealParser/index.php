<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Analisar número Real</title>
</head>

<body>
    <header>
        <h1>Analisar número Real</h1>
    </header>
    <main>
        <?php
        $number = $_POST["number"] ?? 0;

        echo "
            <p>
            *Analisando o número <strong>" . number_format($number, 3, ",", ".") . "</strong> passado pelo usuário...
            </p>
            ";

        $numInt = (int) $number;
        $numFloat = $number - $numInt;

        echo "
            <ul>
                <li>A parte inteira do número é <strong>" . number_format($numInt, 0, ",", ".") . "</strong></li>
                <li>A parte fracionária do número é <strong>" . number_format($numFloat, 3, ",", ".") . "</strong></li>
            </ul>
        "
        ?>
        <button onclick="javascript:history.go(-1)">Voltar</button>
    </main>
</body>

</html>