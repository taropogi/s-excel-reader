<?php

namespace App\Imports;

use App\Models\Log;
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
    public function collection(Collection $rows)
    {

        //delete existing  
        CustomerSkuGroup::where('upload_id', $this->document->id)
            ->where('customer_group', $this->sheetName)
            ->delete();
        $line_ctr = 1;
        $record_error_count = 0;
        foreach ($rows as $row) {
            $obj_arr = json_decode($row);

            $new_group = new CustomerSkuGroup;

            $new_group->upload_id = $this->document->id;
            $new_group->sheet_name = $this->sheetName;
            $new_group->line_number = $line_ctr;
            $new_group->customer_group = $this->sheetName;
            $new_group->account_number =  $obj_arr[0];
            $new_group->account_name = $obj_arr[1];
            $new_group->full_row_obj = json_encode($row);

            if (!$new_group->save()) {
                $record_error_count++;
                Log::create(
                    [
                        'obj' => "",
                        'description' => 'Not Inserted Customer SKU Group'
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
