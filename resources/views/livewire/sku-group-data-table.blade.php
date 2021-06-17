<div>
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