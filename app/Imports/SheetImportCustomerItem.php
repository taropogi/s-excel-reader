<?php

namespace App\Imports;

use App\Models\Log;
use Illuminate\Support\Str;
use App\Models\CustomerItem;
use App\Models\EmptyCellLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SheetImportCustomerItem implements ToCollection, WithEvents, WithCalculatedFormulas
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

        EmptyCellLog::where('upload_id', $this->document->id)
            ->where('sheet_name', $this->sheetName)
            ->delete();

        if (!Str::contains($this->sheetName, 'Xref')) {
            return;
        }

        $line_ctr = 1;
        $record_error_count = 0;
        $empty_cells = 0;
        $empty_cells_arr = [];
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
            // if (is_int($obj_arr[5])) {
            $new_item->rank = $obj_arr[5];
            //   }




            if ($new_item->save()) {
                if (is_null($obj_arr[0])) { //name
                    $empty_cells++;
                    array_push($empty_cells_arr, 'A' . $line_ctr);
                }
                if (is_null($obj_arr[1])) { //description
                    $empty_cells++;
                    array_push($empty_cells_arr, 'B' . $line_ctr);
                }
                if (is_null($obj_arr[2])) { //commodity code
                    $empty_cells++;
                    array_push($empty_cells_arr, 'C' . $line_ctr);
                }
                if (is_null($obj_arr[3])) { //uom code
                    $empty_cells++;
                    array_push($empty_cells_arr, 'D' . $line_ctr);
                }
                if (is_null($obj_arr[4])) { //oracle code
                    $empty_cells++;
                    array_push($empty_cells_arr, 'E' . $line_ctr);
                }
                if (is_null($obj_arr[5])) { //rank
                    $empty_cells++;
                    array_push($empty_cells_arr, 'F' . $line_ctr);
                }
            } else {

                $record_error_count++;
                Log::create(
                    [
                        'description' => 'Not Inserted Customer Item',
                        'obj' => "",

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
            $new_empty_cell->category = 'customer_item';
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
