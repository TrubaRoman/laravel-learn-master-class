@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.users._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-primary  mr-1"> Edit</a>

        <form method="POST" action="{{ route('admin.users.verify',$user) }}" class="mr-1 ">
            @csrf
            @if($user->isActive())
                <button class="btn btn-dark mr-1">Wait</button>
                @else
            <button class="btn btn-success mr-1">Verify</button>
                @endif
        </form>

        <form method="POST" action="{{ route('admin.users.update',$user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
    <table class="table table-bordered table-striped">
        <tbody >
        <tr>
            <th>ID</th> <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th> <td>{{ $user->name}}</td>
        </tr>
        <tr>
            <th>Email</th> <td>{{ $user->email}}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($user->isWait())
                    <span class="badge badge-secondary">Waiting</span>
                @endif
                @if($user->isActive())
                    <span class="badge badge-primary">Active</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Role</th>
            <td>
                @if($user->isAdmin())
                    <span class="badge badge-danger">Admin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>

@endsection