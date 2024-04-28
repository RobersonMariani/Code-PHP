<?php

use App\Polygon;
use App\polygons\Rectangle;
use App\polygons\Square;

require __DIR__ . "/vendor/autoload.php";

$polygon = new Polygon();

$polygon->setShape(new  Rectangle());
$polygon->getShape()->setWidth(5);
$polygon->getShape()->setHeigth(10);
echo "<pre>";
print_r($polygon);
echo "</pre>";

echo $polygon->getArea();

$polygon->setShape(new  Square());
$polygon->getShape()->setWidth(5);
//$polygon->getShape()->setHeigth(10);
echo "<pre>";
print_r($polygon);
echo "</pre>";

echo $polygon->getArea();

/* $rectangle = new Rectangle();

$rectangle->setWidth(5);
$rectangle->setHeigth(10);
echo"<h1>Retângulo</h1>";
echo "Area: " . $rectangle->getArea() . "\n";

echo "<br>";

$square = new Square();

$square->setWidth(5);
//$square->setHeigth(10);
echo"<h1>Quadrado</h1>";
echo "Area: " . $square->getArea() . "\n"; */
