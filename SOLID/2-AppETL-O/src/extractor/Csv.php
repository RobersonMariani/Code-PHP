<?php

namespace App\extractor;

use App\extractor\File;

class Csv extends File
{
    public function readFile(string $path): array
    {
        $handle = fopen($path, "r");

        while (($row = fgetcsv($handle, 10000, ";")) !== false) {
            $this->setData($row[0], $row[1], $row[2]);
        }

        fclose($handle);

        return $this->getData();
    }
}
