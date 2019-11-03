
@extends('admin.layouts.admin_app')
@section('content')
    @include('admin.regions._nav')

    @include('admin.regions._list_regions',['regions' => $regions])

    {{$regions->links()}}
    @endsection