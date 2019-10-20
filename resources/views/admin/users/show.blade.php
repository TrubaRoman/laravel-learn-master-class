@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.users._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-primary mr-1"></a>
        <form action="POST" action="{{ route('admin.users.update',$user) }}" class="mr-1">
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
            <th>ID</th> <td>{{ $user->name}}</td>
        </tr>
        <tr>
            <th>ID</th> <td>{{ $user->email}}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($user->status === \App\Models\User::STATUS_WAIT)
                    <span class="badge badge-secondary">Waiting</span>
                @endif
                @if($user->status === \App\Models\User::STATUS_ACTIVE)
                    <span class="badge badge-primary">Active</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endsection