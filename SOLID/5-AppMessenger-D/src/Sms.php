<?php

namespace App;

class Sms implements ITokenMessage
{
    public function send(): void
    {
        echo "SMS: Seu token é 777-999";
    }
}
