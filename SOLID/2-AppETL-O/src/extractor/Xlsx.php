<?php

namespace App\extractor;

use App\extractor\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Xlsx extends File
{
    public function readFile(string $path)
    {
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }

            $this->setData($rowData[0], $rowData[1], $rowData[2]);
        }
        return $this->getData();
    }
}
