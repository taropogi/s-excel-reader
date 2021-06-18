<?php

namespace App\Http\Livewire;

use App\Models\Upload;
use Livewire\Component;
use App\Models\CustomerItem;
use Livewire\WithPagination;

class CustomerItemDataTable extends Component
{
    use WithPagination;

    public $option_files;
    public $search;
    public $selected_file;


    public function mount()
    {
        $this->option_files = Upload::where('category', 'customer_item')->get();
        $this->search = "";
        $this->selected_file = 0;
    }

    public function re_search()
    {
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function render()
    {

        $data['items'] = CustomerItem::latest()
            ->where('commodity_code', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orWhere('uom', 'like', '%' . $this->search . '%')
            ->orWhere('oracle_code', 'like', '%' . $this->search . '%');

        if (!$this->selected_file == 0) {
            $data['items'] = $data['items']->where('upload_id', $this->selected_file);
        }

        $data['items'] = $data['items']->paginate(20);


        return view('livewire.customer-item-data-table', $data);
    }
}
