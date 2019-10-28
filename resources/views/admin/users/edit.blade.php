@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.users._nav')
    <form method="POST" action="{{ route('admin.users.verify',$user) }}" class="mb-3">
        @csrf
        @if($user->isActive())
            <label for="" class="alert-success  p-2">User is active</label>
        <button class="btn btn-dark float-right">No Activate</button>
            @else
            <label for="" class="alert-danger  p-2"> User is no active</label>
            <button class="btn btn-success float-right ">Activate</button>
            @endif
    </form>
    <form method="post" action="{{route('admin.users.update',$user)}}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : ' ' }}" name="name"
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