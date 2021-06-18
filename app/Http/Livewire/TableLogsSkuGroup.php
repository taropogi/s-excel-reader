<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EmptyCellLog;
use Livewire\WithPagination;

class TableLogsSkuGroup extends Component
{
    use WithPagination;

    public function render()
    {
        $data['empty_cells'] =  EmptyCellLog::where('category', 'sku_group')->latest()->paginate(20);
        return view('livewire.table-logs-sku-group', $data);
    }
}
