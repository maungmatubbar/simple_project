@extends('admin.master')
@section('title')
    Dashboard | Posts | Edit
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Posts</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Posts</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('post.update',['id'=>$post->id]) }}" method="post">@csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-3">Title</label>
                                <div class="col-md-9">
                                    <input type="text" id="title" name="title" value="{{ $post->title }}"  class="form-control" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Enter Description">{{ $post->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9 offset-3">
                                    <input type="submit" class="btn btn-outline-success" value="UPDATE">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
