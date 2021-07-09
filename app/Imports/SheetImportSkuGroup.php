<?php

namespace App\Imports;

use App\Models\Log;
use App\Models\EmptyCellLog;
use App\Models\CustomerSkuGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SheetImportSkuGroup implements ToCollection, WithEvents, WithCalculatedFormulas
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

        EmptyCellLog::where('upload_id', $this->document->id)
            ->where('sheet_name', $this->sheetName)
            ->delete();


        $line_ctr = 1;
        $record_error_count = 0;
        $empty_cells = 0;
        $empty_cells_arr = [];
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

            if ($new_group->save()) {

                if (is_null($obj_arr[0])) { //account number
                    $empty_cells++;
                    array_push($empty_cells_arr, 'A' . $line_ctr);
                }
                if (is_null($obj_arr[1])) { //account name
                    $empty_cells++;
                    array_push($empty_cells_arr, 'B' . $line_ctr);
                }
            } else {

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

        if ($empty_cells > 0) {

            $new_empty_cell = new EmptyCellLog;
            $new_empty_cell->file_name = $this->document->file_name;
            $new_empty_cell->upload_id = $this->document->id;
            $new_empty_cell->sheet_name =  $this->sheetName;
            $new_empty_cell->cells = json_encode($empty_cells_arr);
            $new_empty_cell->category = 'sku_group';
            $new_empty_cell->save();
        }


        $this->document->record_error_count = $record_error_count;
        $this->document->record_empty_cells = count(EmptyCellLog::where('upload_id', $this->document->id)->get());

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
