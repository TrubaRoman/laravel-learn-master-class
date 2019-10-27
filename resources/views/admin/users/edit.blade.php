@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.users._nav')
<h2>Update user</h2>
    <form method="POST" action="{{ route('admin.users.verify',$user) }}" class="mr-1">
        @csrf
        @if($user->isActive())
        <button class="btn btn-dark">Wait</button>
            @else
            <button class="btn btn-success">Active</button>
            @endif
    </form>
    <form method="post" action="{{route('admin.users.update',$user)}}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-controll{{ $errors->has('name') ? ' is-invalid' : ' ' }}" name="name"
                   value="{{old('name',$user->name)}}" required>
            @if($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email"  class="col-form-label">E-Mail Address</label>
            <input id="email" name="email" type="email" class="form-control{{$errors->has('email') ? ' is_invalid' : ''}}"  value="{{old('email',$user->email)}}" required >
            @if($errors->has('email'))
                <span class="invalid-feedback"> <strong>{{$errors->first('email')}}</strong></span>
            @endif
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection