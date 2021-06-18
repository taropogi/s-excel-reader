<?php

namespace App\Http\Livewire;

use App\Models\Upload;
use App\Models\CustomerSkuGroup;
use Livewire\Component;
use Illuminate\Support\Str;

use Livewire\WithPagination;

/*


use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
*/


class SkuGroupDataTable extends Component
{

    use WithPagination;
    public $option_files;
    public $search;
    public $selected_file;

    public function mount()
    {
        $this->option_files = Upload::where('category', 'sku_group')->get();
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

        $data['sku_groups'] = CustomerSkuGroup::latest()
            ->where('customer_group', 'like', '%' . $this->search . '%');


        if (!$this->selected_file == 0) {
            $data['sku_groups'] = $data['sku_groups']->where('upload_id', $this->selected_file);
        }

        $data['sku_groups'] = $data['sku_groups']->paginate(20);

        return view('livewire.sku-group-data-table', $data);
    }
}
