<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Str;
use Livewire\WithPagination;

use App\Models\CustomerSkuGroup;

/*

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
*/


class SkuGroupDataTable extends Component
{

    use WithPagination;

    /*
    public $model = CustomerSkuGroup::class;

   
    public function columns()
    {
        return [
             NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),
 
            Column::name('customer_group')
                ->label('Customer Group')
                ->searchable(),
            Column::name('account_number')
                ->label('Account #')
                ->searchable(),
            Column::name('account_name')
                ->label('Account Name')
                ->searchable(),
            Column::delete(),
        ];
    }
    */


    public function render()
    {
        $data['sku_groups'] = CustomerSkuGroup::latest()->paginate(20);
        return view('livewire.sku-group-data-table', $data);
    }
}
