<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CustomerItem;
use Livewire\WithPagination;

class CustomerItemDataTable extends Component
{
    use WithPagination;


    public function render()
    {
        $data['items'] = CustomerItem::latest()->paginate(20);
        return view('livewire.customer-item-data-table', $data);
    }
}
