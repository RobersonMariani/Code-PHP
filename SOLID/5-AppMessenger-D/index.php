<?php

use App\Email;
use App\Messenger;
use App\Sms;

require __DIR__ . "/vendor/autoload.php";

$msg = new Messenger(new Email);
$msg->sendToken();
echo"<br>";
$msg2 = new Messenger(new Sms);
$msg2->sendToken();

/* $msg = new Messenger();
$msg->setChannel('email');
$msg->sendToken();
echo"<br>";
$msg2 = new Messenger();
$msg2->setChannel('sms');
$msg2->sendToken(); */