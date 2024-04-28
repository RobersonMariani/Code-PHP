<?php

require __DIR__ . "/vendor/autoload.php";

use App\EmailService;
use App\Item;
use App\Order;
use App\ShoppingCart;

$order = new Order();
$cart = new ShoppingCart();

$item = new Item();
$item2 = new Item();
$item->setDescription('Porta copo');
$item->setValue(4.55);
$item2->setDescription('Lampâda');
$item2->setValue(8.32);

echo "<h1>Pedido Iniciado</h1>";
echo "<pre>";
print_r($order);
echo "</pre>";

$order->getShoppingCart()->addItem($item);
$order->getShoppingCart()->addItem($item2);

echo "<h1>Pedido com Itens</h1>";
echo "<pre>";
print_r($order);
echo "</pre>";

echo "<h1>Itens do carrinho</h1>";
echo "<pre>";
print_r($order->getShoppingCart()->getItems());
echo "</pre>";

echo "<h1>Valor do pedido</h1>";
echo "<pre>";
$total = 0;
foreach ($order->getShoppingCart()->getItems() as $item) {
    $total += $item->getValue();
    echo "
        {$item->getDescription()} R$ {$item->getValue()}
    ";
}
echo "Total do pedido: $total";
echo "</pre>";

echo "<h1>Carrinho está válido?</h1>";
echo $order->getShoppingCart()->cartValidate() ? "Válido" : "Inválido";

echo "<h1>Status do Pedido</h1>";
echo $order->getStatus();

echo "<h1>Confirmar pedido</h1>";
echo $order->confirm() ? "Analisando..." : "Erro...";;

echo "<h1>Status do Pedido</h1>";
echo $order->getStatus();

echo "<h1>E-mail</h1>";
if($order->getStatus() == "confirmado"){
    echo EmailService::triggerEmail();
}