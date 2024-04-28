<?php

namespace App\extractor;

class File
{
    private $data = array();

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of directory
     *
     * @return  self
     */
    public function setData(string $name, string $cpf, string $email): void
    {
        array_push(
            $this->data,
            [
                "name" => iconv("iso-8859-1", "UTF-8", $name), "cpf" => $cpf,
                "email" => $email
            ]
        );
    }
}
