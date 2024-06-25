<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    @if ($admin->id === auth()->user()->id)
                        <span class="text-muted">
                            Its you
                        </span>
                    @else
                        <button class="badge bg-danger border-0" onclick="changeRole({{ $admin->id }}, 'demote')">
                            <div class="d-flex align-items-center">
                                <span data-feather="chevrons-down"></span> Demote
                            </div>
                        </button>
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
