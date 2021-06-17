<div>
    <table class="table table-sm small table-striped table-hover">
        <thead>
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