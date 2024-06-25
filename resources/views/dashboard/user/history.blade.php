<table class="table table-striped table-sm">
    @if ($histories->count())
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Username</th>
                <th scope="col">Change By</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $history->user->username }}</td>
                    <td>{{ $history->changer->username }}</td>
                    <td>{{ $history->change_date }}</td>
                    <td>
                        <span class="badge @if ($history->change_type === 'PROMOTE') bg-success @else bg-danger @endif rounded-pill d-inline">
                            {{ $history->change_type }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
@else
<p class="text-center fs-4">No Histories Found.</p>
@endif
