<tr>
    <th scope="row">{{ $file->id }}</th>
    <td>{{ $file->file_name }}</td>
    <td>{{ $file->date_modified->diffForHumans() }}</td>
    <td>{{ $file->size() }}</td>
    <td>{{ $file->import_duration() }}</td>
    <td>{{ $file->record_count }}</td>
    <td></td>
    <td>
        <button wire:loading class="btn btn-warning btn-sm" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Importing...
        </button>

        <div wire:loading.remove class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" wire:click="import">Import</button>
            <button type="button" class="btn btn-success" wire:click="download_file">Download</button>
        </div>
    </td>
</tr>