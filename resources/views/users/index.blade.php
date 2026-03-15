@extends('layouts.app')

@section('content')
<div class="header">User Management</div>
<div class="page-content">
    <div class="toolbar">
        <h1 class="page-title">Users List</h1>
        <a href="{{ route('users.create') }}" class="btn">Create New User</a>
    </div>

    <div class="datatable-container">
        <table id="users-table" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-outline" style="font-size:.82rem; padding:.35rem .7rem;">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" class="delete-user-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="font-size:.82rem; padding:.35rem .7rem; margin-left: 6px;" data-name="{{ $user->name }}">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <div style="margin-top: 18px;">{{ $users->links() }}</div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#users-table').DataTable({
        paging: false,
        info: false,
        searching: true,
        columnDefs: [{ orderable: false, targets: 4 }]
    });

    $(document).on('submit', '.delete-user-form', function (event) {
        event.preventDefault();
        let form = this;
        const name = $(this).find('button').data('name');

        if (confirm(`Are you sure you want to delete ${name}?`)) {
            form.submit();
        }
    });
});
</script>
@endpush
