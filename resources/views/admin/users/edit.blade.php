@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.users._nav')
<h2>Update user</h2>
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
            <label for="status" class="col-form-label">Status</label>
            <select name="status" id="status" type="email" class="form-control{{$errors->has('status') ? ' is_invalid': ' '}}">
                @foreach($statuses as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('status',$user->status) ? ' selected': ''}}>{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('email'))
                <span class="invalid-feedback"><strong>{{$errors->first('status')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection