<tr>
    <th scope="row">{{ $file->id }}</th>
    <td>{{ $file->file_name }}</td>
    <td>{{ $file->date_modified->diffForHumans() }}</td>
    <td>{{ $file->size() }}</td>
    <td>{{ $file->import_duration() }}</td>
    <td>{{ $file->record_count }}</td>
    <td>{{ $file->record_error_count }}</td>
    <td>
        <button wire:loading wire:target="import" class="btn btn-primary btn-sm" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Importing...
        </button>
        <button wire:loading wire:target="download_file" class="btn btn-success btn-sm" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Downloading...
        </button>
        <button wire:loading wire:target="delete_file" class="btn btn-danger btn-sm" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Deleting...
        </button>

        <div wire:loading.remove class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" wire:click="import">Import</button>
            <button type="button" class="btn btn-success" wire:click="download_file">Download</button>
            <button type="button" class="btn btn-danger" wire:click="delete_file">Delete</button>
        </div>
    </td>
</tr>