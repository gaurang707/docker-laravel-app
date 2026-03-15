@extends('layouts.app')

@section('content')
<div class="header">User Management</div>
<div class="page-content">
    <div class="toolbar">
        <h1 class="page-title">Edit User</h1>
        <a href="{{ route('users.index') }}" class="btn btn-outline">Back to List</a>
    </div>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Password (leave blank if no change)</label><br>
            <input type="password" name="password">
            @error('password')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Confirm Password</label><br>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit" class="btn">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-outline" style="margin-left: 10px;">Cancel</a>
    </form>
</div>
@endsection
