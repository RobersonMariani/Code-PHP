<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Conversão de Moeda</title>
</head>

<body>
    <header>
        <h1>Conversão Real para Dolár</h1>
    </header>
    <main>
        <?php
        $value = $_POST["value"];
        $dateStart = $_POST["dateStart"] ?? date("m-d-Y", strtotime("-7 day"));
        $dateEnd = $_POST["dateEnd"] ?? date("m-d-Y");

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $dateStart . '\'&@dataFinalCotacao=\'' . $dateEnd . '\'&$top=100&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,cotacaoVenda,dataHoraCotacao';

        $data = json_decode(file_get_contents($url), true);

        $price = $data["value"][0]["cotacaoCompra"];
        $conversion = $value / $price;
        $default = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

        $arrayData = [];
        echo "
            <h1>Cotação dos últimos 7 dias</h1>
            <table>
            <thead>
                <tr>
                    <th>Cotação de Compra</th>
                    <th>Cotação de Venda</th>
                    <th>Data da Cotação</th>
                </tr>
            </thead>
            <tbody>
            ";
        foreach ($data["value"] as $dataValue) {
            echo "
                        <tr>
                            <td>" . $dataValue["cotacaoCompra"] . "</td>
                            <td>" . $dataValue["cotacaoVenda"] . "</td>
                            <td>" . $dataValue["dataHoraCotacao"] . "</td>
                        </tr>
                ";
        }
        echo "
            </tbody>
            </table>
            ";
        echo "
        <p>
        Seus " . numfmt_format_currency($default, $value, "BRL") . " equivalem a <strong>" . numfmt_format_currency($default, $conversion, "USD") . "</strong>
        </p>
            <p>*Cotação atual de <strong>$price</strong></p>
            <p>
            <strong>*Cotação direta do Banco Central</strong>
            </p>";
        ?>
        <button onclick="javascript:history.go(-1)">Voltar para a conversão</button>
    </main>
</body>

</html>