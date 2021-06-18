<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EmptyCellLog;
use Livewire\WithPagination;

class TableEmptyCellLog extends Component
{
    use WithPagination;

    public function render()
    {
        $data['empty_cells'] =  EmptyCellLog::latest()->paginate(20);
        return view('livewire.table-empty-cell-log', $data);
    }
}
