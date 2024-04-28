<?php

namespace App;

class EmailService
{
    private $to;
    private $from;
    private $subject;
    private $content;

    public function __construct(string $to = "", string $from = "", string $subject = "", string $content = "")
    {
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->content = $content;
    }

    public static function triggerEmail()
    {
        return "--- envia e-mail ---";
    }
}
