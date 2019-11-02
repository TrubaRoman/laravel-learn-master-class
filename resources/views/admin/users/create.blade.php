@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.users._nav')
<h2>Create user</h2>
    <form method="post" action="{{route('admin.users.store')}}">
        @csrf
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : ' ' }}" name="name"
            value="{{old('name')}}" required>
        @if($errors->has('name'))
            <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
        @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input id="email" name="email" type="email" class="form-control{{$errors->has('email') ? ' is_invalid' : ''}}"  value="{{old('email')}}" required >
        @if($errors->has('email'))
            <span class="invalid-feedback"> <strong>{{$errors->first('email')}}</strong></span>
        @endif
        </div>
        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select name="role" id="role" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}"{{$value === old('role',$user->role) ? ' selected' : ''}}>{{ $label }}</option>
                @endforeach
            </select>
            @if($error->has('role'))
                <span class="invalid-feedback"><strong>{{$errors->first('role')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection