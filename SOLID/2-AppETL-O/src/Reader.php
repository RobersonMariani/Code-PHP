<?php

namespace App;

use App\extractor\File;

class Reader
{
    private $directory;
    private $file;

    /**
     * Get the value of directory
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * Set the value of directory
     *
     * @return  self
     */
    public function setDirectory(string $directory): void
    {
        $this->directory = $directory;
    }

    /**
     * Get the value of file
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    public function readFile(): array
    {
        $path = $this->getDirectory() . "/" . $this->getFile();
        $ext = explode(".", $this->getFile());

        $class = "\App\\extractor\\" . ucfirst($ext[1]);

        return call_user_func_array(
            [
                new $class,
                "readFile",
            ],
            [
                $path
            ]
        );
    }
}
