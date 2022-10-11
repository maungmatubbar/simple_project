@extends('admin.master')
@section('title')
    Dashboard | Posts
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Posts</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Posts</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between  align-items-center">
                        <div class="card-title">Posts</div>
                        <div class=""><a href="{{ route('post.create') }}" class="btn btn-success">Add New Post</a></div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ Session::get('message') }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Posted By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td>{{ $post->post_by }}</td>
                                    <td>
                                        @if($post->status==1)
                                            <a class="status" href="javascript:void(0)" id="status-{{ $post->id }}" record="post" record_id="{{ $post->id }}"><i class="toggle fa fa-2x fa-toggle-on" status="active"></i></a>
                                        @else
                                            <a class="status" href="javascript:void(0)" id="status-{{ $post->id }}" record="post" record_id="{{ $post->id }}"><i class="toggle fa fa-2x fa-toggle-off" status="inactive"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                       <span class="btn-group">
                                            <a href="{{ route('post.edit',['id'=>$post->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('post.delete',['id'=>$post->id]) }}" onclick="return confirm('Are you sure delete this?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                       </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
