<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\CustomerSkuGroup;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerSkuGroupImport;

class RowFileSkuGroup extends Component
{

    public $file;

    public function import()
    {


        $document = $this->file;


        $import_start = Carbon::now();
        $ts =  Excel::import(new CustomerSkuGroupImport($document), storage_path($document->full_storage_path));

        //sleep for 2 seconds
        sleep(2);


        $import_end = Carbon::now();
        $upload_rows = CustomerSkuGroup::where('upload_id', $document->id)->get();
        $this->file->import_start = $import_start;
        $this->file->import_end = $import_end;
        $this->file->record_count = count($upload_rows);

        $this->file->save();

        /*
        $file_contents = base64_decode($document->blob_file);



        $f = (response($file_contents)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Type', $document->mime_type)
            ->header('Content-length', strlen($file_contents))
            ->header('Content-Disposition', 'attachment; filename=' . $document->file_name)
            ->header('Content-Transfer-Encoding', 'binary'));
            */
    }

    public function render()
    {
        return view('livewire.row-file-sku-group');
    }
}
