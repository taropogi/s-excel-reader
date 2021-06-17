<?php

namespace App\Imports;

use App\Models\Log;
use App\Models\CustomerItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\ToCollection;

class SheetImportCustomerItem implements ToCollection, WithEvents
{
    /**
     * @param Collection $collection
     */

    public $sheetName;
    public $document;

    public function __construct($document)
    {
        $this->sheetName = "";
        $this->document = $document;
    }

    public function collection(Collection $rows)
    {

        //delete existing  

        CustomerItem::where('upload_id', $this->document->id)
            ->where('sheet_name', $this->sheetName)
            ->delete();


        $line_ctr = 1;
        $record_error_count = 0;
        foreach ($rows as $row) {
            $obj_arr = json_decode($row);


            $new_item = new CustomerItem;
            $new_item->upload_id = $this->document->id;
            $new_item->sheet_name = $this->sheetName;
            $new_item->line_number = $line_ctr;
            $new_item->commodity_code = $obj_arr[2];
            $new_item->name = $obj_arr[0];
            $new_item->description = $obj_arr[1];
            $new_item->uom = $obj_arr[3];
            $new_item->oracle_code = $obj_arr[4];



            if (!$new_item->save()) {
                $record_error_count++;
                Log::create(
                    [
                        'obj' => "",
                        'description' => 'Not Inserted Customer Item'
                    ]
                );
            }

            $line_ctr++;
        }

        $this->document->record_error_count = $record_error_count;
        $this->document->save();
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
