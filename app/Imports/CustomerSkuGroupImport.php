<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CustomerSkuGroupImport implements WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public $document;
    public function __construct($document)
    {
        $this->document = $document;
    }

    public function sheets(): array
    {
        $arr = [];

        for ($x = 0; $x <= 50; $x++) {
            $arr[$x] = new SheetImportSkuGroup($this->document);
        }



        return $arr;
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
