<?php

namespace App\Http\Livewire;


use App\Models\Upload;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class UploadFile extends Component
{

    use WithFileUploads;

    public $file;
    public $category;

    public function save()
    {
        $this->validate([
            'file' => 'required|max:10240', // 10MB Max
        ]);

        $new_file_name = sha1(time()) . '.xls';
        $path = $this->file->storeAs('xls', $new_file_name);
        $full_path = storage_path('app/' . $path);
        $xls = file_get_contents($full_path);

        $base64 = base64_encode($xls);


        $file_name = $this->file->getClientOriginalName();
        $duplicates = Upload::where('file_name', 'like', '%' . $file_name . '%')->get();

        $mdate = date("Y-m-d H:i:s", File::lastModified($full_path));
        $size = Storage::size($path);

        $mimetype = Storage::mimeType($path);

        Upload::create([
            'file_name' => $this->file->getClientOriginalName() . (count($duplicates) > 0 ? '-' . count($duplicates) : ''),
            'orig_file_name' => $this->file->getClientOriginalName(),
            'file_type' => $this->file->getClientOriginalExtension(),
            'new_file_name' => $new_file_name,
            'category' => ($this->category ?? 'category'),
            'blob_file' => $base64,
            'date_modified' => $mdate,
            'size' => $size,
            'mime_type' => $mimetype,
            'full_storage_path' => 'app/' . $path,
            'upload_by' => auth()->user()->id,

        ]);


        $this->emit('FileUploaded');
    }



    public function render()
    {
        return view('livewire.upload-file');
    }
}
