
@extends('admin.layouts.admin_app')
@section('content')
    @include('admin.users._nav')

    <div class="card mb-3">
        <div class="card-header" >Filter</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label" >ID</label>
                            <input id="id" class="form-control"  name="id" value="{{request('id')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="id" class="col-form-label" >Name</label>
                            <input id="id" class="form-control" name="name"  value="{{request('name')}}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="id" class="col-form-label"  >Email</label>
                            <input id="id" class="form-control"  name="email" value="{{request('email')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
                                @foreach($statuses as $value => $label)
                                    <option value="{{$value}}" {{$value === request('status') ? ' selected':''}} >{{$label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="role" class="col-form-label">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value=""></option>
                                @foreach($roles as $value => $label)
                                    <option value="{{$value}}" {{$value === request('role') ? ' selected':''}} >{{$label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label"> &nbsp;</label><br />
                            <button class="btn btn-primary"  type="submit">Search</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="role" class="col-form-label">Order by</label>
                            <select name="order_by" id="order_by" class="form-control">
                                <option value=""></option>
                                @foreach($sort_list as $value => $label)
                                    <option value="{{$value}}" {{$value === request('order_by') ? ' selected':''}} >{{$label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="col-form-label"> &nbsp;</label><br />
                        <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">

                            <label class="btn btn-secondary active">
                                <input type="radio" name="order" id="option1" autocomplete="off"  value="desc"  checked> &uArr;
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="order" id="option2" autocomplete="off" value="asc"> &dArr;
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
        </tr>
        </thead>

        <tbody>

        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><a href="{{ route('admin.users.show',$user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>
                @if($user->isWait())
                    <span class="badge badge-secondary">Waiting</span>
                @endif
                @if($user->isActive())
                    <span class="badge badge-primary">Active</span>
                @endif
            </td>
            <td>
                @if($user->isAdmin())
                    <span class="badge badge-danger">Admin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
        </tr>
         @endforeach
        </tbody>
    </table>
    {{$users->links()}}
    @endsection