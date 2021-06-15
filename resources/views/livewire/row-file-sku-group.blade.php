<tr>
    <th scope="row">{{ $file->id }}</th>
    <td>{{ $file->file_name }}</td>
    <td>{{ $file->date_modified->diffForHumans() }}</td>
    <td>{{ $file->size() }}</td>
    <td>{{ $file->record_count }}</td>
    <td></td>
    <td></td>
    <td>
        <h1 wire:loading>Loading . . . .</h1>
        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" wire:click="import">Import</button>
        </div>
    </td>
</tr>