<?php

namespace App\Http\Livewire;

use App\Models\Upload;
use Livewire\Component;

class PageFilesItems extends Component
{

    protected $listeners = [
        'FileUploaded' => '$refresh',
        'FileDeleted' => '$refresh',
    ];


    public function render()
    {
        $data['files'] = Upload::latest()->where('category', 'customer_item')->get();
        return view('livewire.page-files-items', $data);
    }
}
