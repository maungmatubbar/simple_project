@extends('admin.master')
@section('title')
    Dashboard | Posts | Add New
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Posts</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Posts</a></li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                        @if($errors->any())
                            <div class="card-header">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('message'))
                            <div class="card-header">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ Session::get('message') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    <div class="card-body">
                        <form action="{{ route('post.store') }}" method="post">@csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-3">Title</label>
                                <div class="col-md-9">
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9 offset-3">
                                    <input type="submit" class="btn btn-outline-success" value="CREATE">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
