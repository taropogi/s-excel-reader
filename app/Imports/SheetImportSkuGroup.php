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
    public $document;

    public function __construct($document)
    {
        $this->sheetNames = "";
        $this->document = $document;
    }
    public function collection(Collection $row)
    {

        for ($x = 0; $x <= 1000; $x++) {
            if (isset($row[$x])) {
                $obj_arr = json_decode($row[$x]);

                //delete existing row
                CustomerSkuGroup::where('upload_id', $this->document->id)
                    ->where('customer_group', $this->sheetName)
                    ->where('account_number', $obj_arr[0])
                    ->delete();



                CustomerSkuGroup::create([
                    'customer_group'     => $this->sheetName,
                    'account_number' => $obj_arr[0],
                    'account_name' => $obj_arr[1],
                    'full_row_obj'     => $row[$x],
                    'upload_id'     => $this->document->id
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
