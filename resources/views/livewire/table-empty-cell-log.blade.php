<div>
    <table class="table table-sm small table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 20%;">File Name</th>
                <th scope="col" style="width: 20%;">Sheet Name</th>
                <th scope="col">Cells</th>
            </tr>
        </thead>
        <tbody>

            @foreach($empty_cells as $cell)
            <tr>
                <td>{{ $cell->file_name }}</td>
                <td>{{ $cell->sheet_name }}</td>
                <td>
                    @foreach(json_decode($cell->cells) as $c)
                    <span class="badge bg-primary">{{ $c }}</span>
                    @endforeach
                </td>
            </tr>
            @endforeach



        </tbody>
    </table>
    {{ $empty_cells->links() }}
</div>