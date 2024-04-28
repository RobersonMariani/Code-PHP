<?php

namespace App;

class Email implements ITokenMessage
{
    public function send(): void
    {
        echo "E-mail: Seu token é 222-333";
    }
}
