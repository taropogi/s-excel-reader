<div>
    <livewire:upload-file :category="'sku_group'" />
    <table class="table table-sm small">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">File <br>Name</th>
                <th scope="col">Modified <br> Date</th>
                <th scope="col">Size</th>
                <th scope="col">Import <br> Duration</th>
                <th scope="col">Record <br> Count</th>
                <th scope="col">Extracted <br> Count</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            @livewire('row-file-sku-group',['file' => $file],key($file->id))
            @endforeach
        </tbody>
    </table>
</div>