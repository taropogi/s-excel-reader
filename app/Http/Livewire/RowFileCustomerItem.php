<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\CustomerItem;
use Illuminate\Support\Carbon;
use App\Imports\CustomerItemImport;
use Maatwebsite\Excel\Facades\Excel;

class RowFileCustomerItem extends Component
{
    public $file;

    public function import()
    {


        $document = $this->file;

        $import_start = Carbon::now();
        $ts =  Excel::import(new CustomerItemImport($document), storage_path($document->full_storage_path));

        //sleep for 2 seconds
        sleep(2);

        $import_end = Carbon::now();
        $upload_rows = CustomerItem::where('upload_id', $document->id)->get();
        $this->file->import_start = $import_start;
        $this->file->import_end = $import_end;
        $this->file->record_count = count($upload_rows);

        $this->file->save();
    }

    public function download_file()
    {
        sleep(3);

        $filePath = storage_path($this->file->full_storage_path);
        $headers = ['Content-Type: ' . $this->file->mime_type];
        $fileName = $this->file->file_name . '.' . $this->file->file_type;

        return response()->download($filePath, $fileName, $headers);
    }

    public function delete_file()
    {
        sleep(3);
        $this->file->delete();
        $this->emit('FileDeleted');
    }


    public function render()
    {
        return view('livewire.row-file-customer-item');
    }
}
