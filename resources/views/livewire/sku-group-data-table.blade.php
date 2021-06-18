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
            <tr>
                <th scope="col">Group</th>
                <th scope="col">Account #</th>
                <th scope="col">Account Name</th>
            </tr>
        </thead>
        <tbody>

            @foreach($sku_groups as $group)

            <tr>
                <td>
                    {{ $group->customer_group }}
                </td>
                <td>
                    {{ $group->account_number }}
                </td>
                <td>
                    {{ $group->account_name }}
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
    {{ $sku_groups->links() }}
</div>