<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EmptyCellLog;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableLogsCustomerItem extends Component
{
    use WithPagination;

    public function render()
    {
        $data['empty_cells'] =  EmptyCellLog::where('category', 'customer_item')->latest()->paginate(20);
        return view('livewire.table-logs-customer-item', $data);
    }
}
