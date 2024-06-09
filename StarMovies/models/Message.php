<?php

class Message
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the value of message
     */
    public function getMessage()
    {
        if (!empty($_SESSION["msg"])) {
            return [
                "msg" => $_SESSION["msg"],
                "type" => $_SESSION["type"],
            ];
        } else {
            return false;
        }
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($msg, $type, $redirect = "index.php")
    {
        $_SESSION["msg"] = $msg;
        $_SESSION["type"] = $type;

        if ($redirect != "back") {
            header("Location: $this->url" . $redirect);
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function clearMessage()
    {
        unset($_SESSION["msg"]);
        unset($_SESSION["type"]);
    }
}
