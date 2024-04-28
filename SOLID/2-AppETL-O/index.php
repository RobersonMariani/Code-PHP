<?php

require __DIR__ . "/vendor/autoload.php";

use App\Reader;

//--------------------------CSV----------------------------//
$readerCSV = new Reader();

$readerCSV->setDirectory(__DIR__ . "/files");
$readerCSV->setFile("dados.csv");
$arrCSV = $readerCSV->readFile();
//---------------------------TXT---------------------------//
$readerTXT = new Reader();

$readerTXT->setDirectory(__DIR__ . "/files");
$readerTXT->setFile("dados.txt");
$arrTXT = $readerTXT->readFile();
//---------------------------XLSX--------------------------//
$readerXLSX = new Reader();

$readerXLSX->setDirectory(__DIR__ . "/files");
$readerXLSX->setFile("dados.xlsx");
$arrXLSX = $readerXLSX->readFile();
//-------------------------Merge arrays--------------------//
echo "<pre>";
print_r(array_merge($arrCSV, $arrTXT, $arrXLSX));
echo "</pre>";
