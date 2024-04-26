<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Gerador de Número Aleatório</title>
</head>

<body>
    <header>
        <h1>Gerador de Números Aleatórios</h1>
    </header>

    <main>
        <p>Gerando um número aleatório entre 0 e 100...</p>
        <?php
        $numeroAleatorio = rand(0, 100);
        echo "<p>O número gerado é <strong>{$numeroAleatorio}</strong></p>";
        ?>
         <button onclick="javascript:location.reload()"></button>
    </main>
</body>

</html>