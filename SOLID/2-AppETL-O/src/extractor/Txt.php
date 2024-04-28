<?php

namespace App\extractor;

use App\extractor\File;

class Txt extends File
{
    public function readFile(string $path): array
    {
        $handle = fopen($path, "r");

        while (!feof($handle)) {
            $row = fgets($handle);
            $this->setData(
                substr($row, 11, 30),
                substr($row, 0, 11),
                substr($row, 41, 50)
            );
        }

        fclose($handle);

        return $this->getData();
    }
}
