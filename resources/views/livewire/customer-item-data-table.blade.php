<div>

    <form wire:submit.prevent>
        <div class="row m-2">
            <div class="col">
                <input wire:model.defer="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="col">
                <div class="input-group mr-2">
                    <label class="input-group-text" for="inputGroupSelect01">File</label>
                    <select class="form-select" wire:model.defer="selected_file">
                        <option value="0">ALL</option>
                        @foreach($option_files as $file)
                        <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <button wire:loading.remove class="btn btn-outline-success" type="submit" wire:click="re_search">Search</button>
                <button wire:loading class="btn btn-primary mb-2" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Searching...
                </button>
            </div>
        </div>
    </form>


    <table class="table table-sm small table-striped table-hover">
        <thead>
            @if($selected_file == 0)
            <tr>
                <th colspan="5" class="table-primary text-center">Show all data</th>
            </tr>
            @elseif($selected_file > 0)
            <tr>
                <th colspan="5" class="table-danger text-center">{{ $selected_file_obj->file_name }}</th>
            </tr>
            @endif
            <tr>
                <th scope="col">Commodity Code</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">UOM</th>
                <th scope="col">Oracle Code</th>
            </tr>
        </thead>
        <tbody>

            @foreach($items as $item)

            <tr>
                <td>
                    {{ $item->commodity_code }}
                </td>
                <td>
                    {{ $item->name }}
                </td>
                <td>
                    {{ $item->description }}
                </td>
                <td>
                    {{ $item->uom }}
                </td>
                <td>
                    {{ $item->oracle_code }}
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
    {{ $items->links() }}
</div>