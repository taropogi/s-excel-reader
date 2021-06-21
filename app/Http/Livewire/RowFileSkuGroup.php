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
    public $import_by_str;

    public function mount()
    {
        if ($this->file->import_by_f) {
            $this->import_by_str = $this->file->import_by_f->name;
        } else {
            $this->import_by_str = "";
        }
    }

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
        $this->file->import_by = auth()->user()->id;

        $this->import_by_str = auth()->user()->name;


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
        return view('livewire.row-file-sku-group');
    }
}
