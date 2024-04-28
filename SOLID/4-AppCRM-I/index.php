<?php

use App\dao\ContractModel;
use App\dao\LeadModel;
use App\dao\UserModel;

require __DIR__ . "/vendor/autoload.php";

$contractModel = new ContractModel();
echo "<pre>";
print_r($contractModel);
echo "</pre>";
echo "<br>";

$leadModel = new LeadModel();
echo "<pre>";
print_r($leadModel);
echo "</pre>";
echo "<br>";

$userModel = new UserModel();
echo "<pre>";
print_r($userModel);
echo "</pre>";
echo "<br>";
