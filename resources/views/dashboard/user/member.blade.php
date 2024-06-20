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
        @foreach ($members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->email }}</td>
                <td>
                    <button class="badge bg-success border-0" onclick="changeRole({{ $member->id }}, 'promote')">
                        <div class="d-flex align-items-center">
                            <span data-feather="chevrons-up"></span> Promote
                        </div>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
