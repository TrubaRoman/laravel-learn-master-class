
@extends('admin.layouts.admin_app')
@section('content')
    @include('admin.regions._nav')
    <p><a href="{{ route('admin.regions.create') }}" class="btn btn-success">Add Region</a></p>
    @include('admin.regions._list_regions',['regions' => $regions])

    {{$regions->links()}}
    @endsection