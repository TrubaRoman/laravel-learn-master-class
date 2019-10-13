@extends('layouts.app')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
        <li class="breadcrumb-item">Cabinet</li>
    </ul>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection
