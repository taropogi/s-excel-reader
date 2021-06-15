<?php

namespace App\Http\Livewire;

use App\Models\Upload;
use Livewire\Component;

class PageFilesSkuGroup extends Component
{

    protected $listeners = [
        'CustomerSkuGroupSaved' => '$refresh'
    ];


    public function render()
    {
        $data['files'] = Upload::latest()->where('category', 'sku_group')->get();
        return view('livewire.page-files-sku-group', $data);
    }
}
