<?php

namespace App\Imports;

use App\Models\CustomerSkuGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SheetImportSkuGroup implements ToCollection, WithEvents
{
    /**
     * @param Collection $collection
     */

    public $sheetName;

    public function __construct()
    {
        $this->sheetNames = "";
    }
    public function collection(Collection $row)
    {

        for ($x = 0; $x <= 1000; $x++) {
            if (isset($row[$x])) {
                $obj_arr = json_decode($row[$x]);
                CustomerSkuGroup::create([
                    'customer_group'     => $this->sheetName,
                    'account_number' => $obj_arr[0],
                    'account_name' => $obj_arr[1],
                    'full_row_obj'     => $row[$x],
                ]);
            } else {
                break;
            }
        }
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $this->sheetName  = $event->getSheet()->getTitle();
            }
        ];
    }
}
