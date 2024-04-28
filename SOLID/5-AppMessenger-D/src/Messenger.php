<?php

namespace App;

use App\Email;

class Messenger
{
    public function __construct(ITokenMessage $channel)
    {
        $this->setChannel($channel);
    }

    private $channel;

    /**
     * Get the value of channel
     */
    public function getChannel(): ITokenMessage
    {
        return $this->channel;
    }

    /**
     * Set the value of channel
     *
     * @return  self
     */
    public function setChannel(ITokenMessage $channel): void
    {
        $this->channel = $channel;
    }

    public function sendToken(): void
    {
        $this->getChannel()->send();
    }
}
