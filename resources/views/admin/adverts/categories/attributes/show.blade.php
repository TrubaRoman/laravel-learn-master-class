@extends('admin.layouts.admin_app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.adverts.categories.attributes.edit',[$category,$attribute])}}" class="btn btn-primary mr-1"> Edit</a>
        <form method="POST" action="{{route('admin.adverts.categories.attributes.destroy',[$category, $attribute])}}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" > Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody >
        <tr>
            <th>ID</th> <td>{{ $attribute->id }}</td>
        </tr>
        <tr>
            <th>Name</th> <td>{{ $attribute->name}}</td>
        </tr>
        <tr>
            <th>Sort</th> <td>{{ $attribute->sort}}</td>
        </tr>
        <tr>
            <th>Type</th> <td>{{ $attribute->type}}</td>
        </tr>
{{--        {{dd($attribute->variants)}}--}}
        <tr>
            <th>Variants</th> <td>{{  implode("\n", $attribute->variants)}}</td>
        </tr>

        </tbody>
    </table>

{{--    <table class="table table-bordered table-striped">--}}
{{--        <thead>--}}
{{--            <tr>--}}
{{--                <th>Sort</th>--}}
{{--                <th>Name</th>--}}
{{--                <th>Slug</th>--}}
{{--                <th>Required</th>--}}
{{--            </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--            @foreach($attributes as $attribute)--}}
{{--                <tr>--}}
{{--                    <td>{{$attribute->sort}}</td>--}}
{{--                    <td><a href="{{route('admin.adverts.categories.attributes.show',[$category,$attribute])}}">--}}
{{--                            {{$attribute->name}}--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td>{{$attribute->type}}</td>--}}
{{--                    <td>{{$attribute->required ? 'Yes': ''}}</td>--}}
{{--                </tr>--}}
{{--                @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}

@endsection