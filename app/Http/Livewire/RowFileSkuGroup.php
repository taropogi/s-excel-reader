<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Imports\CustomerSkuGroupImport;
use Maatwebsite\Excel\Facades\Excel;

class RowFileSkuGroup extends Component
{

    public $file;

    public function import()
    {


        $document = $this->file;



        $ts =  Excel::import(new CustomerSkuGroupImport, storage_path($document->full_storage_path));

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
