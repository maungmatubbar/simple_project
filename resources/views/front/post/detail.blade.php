@extends('front.master')
@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <div class="my-4">
            <div class="card border-0">
                <div class="card-body p-0 d-flex justify-content-between">
                    <div class="card-title">
                       Post Details
                    </div>
                    <a href="{{ route('post.edit',['id'=>$post->id]) }}" target="_blank" class="btn btn-success w-25 {{Auth::guard('admin')->user()?'': 'disabled'}}">Edit</a>
                </div>
            </div>
        </div>
        <!-- Blog Post -->
        <div class="card mb-5 shadow">
            <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                <p class="card-text">{{ $post->description }}</p>
            </div>
        </div>
        <div class="card mb-3 shadow">
            <div class="card-header">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('message') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">
                    Add a comment
                </h3>
                <form action="{{ route('comment.store') }}" method="post">@csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="text" name="name" placeholder="Enter Name" class="form-control shadow">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <textarea name="comment" id="" cols="30" rows="5" placeholder="Comment" class="form-control shadow"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="submit" value="Submit Comment" class="btn btn-success" {{ Auth::guard('web')->user()?'':'disabled' }}>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        @foreach($comments as $comment)
            <div>
                <div class="card m-0 card-body mb-2 rounded-0" id="commentBox-{{ $comment->id }}">
                    <div class="row">
                        <div class="card-text col-md-9">
                            <h5 class="p-0">{{ $comment->name }}</h5>
                            <p class="p-0">{{ date('M d,Y',strtotime( $comment->created_at))  }}</p>
                            <p class="p-0">{{ $comment->comment }} by {{ $comment->name }}</p>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="mt-4">
                                <button class="btn btn-info reply_btn" replyBoxId="{{ $comment->id }} {{ Auth::guard('web')->user()?'':'disabled' }}">Reply</button>
                                <button class="btn btn-success comment_hide" {{ Auth::guard('admin')->user()?'':' disabled' }} comment_id="{{ $comment->id }}">Hide</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 border-0 replyBox"  id="{{ $comment->id }}">
                        <div class="card-body">
                            <h3 class="card-title">
                                Reply
                            </h3>
                            <form action="{{ route('reply.store') }}" method="post">@csrf
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="parent_id" value="0">
                                        <textarea name="message" id="" cols="30" rows="5" placeholder="Reply message" class="form-control shadow"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="submit" value="Reply" class="btn btn-success" {{ Auth::guard('web')->user()?'':'disabled' }}>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                @foreach($comment->replies as $reply)
                    <div>
                        <div class="card card-body ml-5 mb-2" id="reply-{{ $reply->id }}">
                            <div class="row">
                                <div class="card-text col-md-9">
                                    <h5 class="p-0">{{ $reply->name }}</h5>
                                    <p class="p-0">{{ date('M d,Y',strtotime( $reply->created_at)) }}</p>
                                    <p class="p-0">{{ $reply->message }} by {{ $reply->name }}</p>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary subReply_btn {{ Auth::guard('web')->user()?'':'disabled' }}" subReplyBoxId="{{ $reply->id }}">Reply</button>
                                        <button class="btn btn-success replyHide" reply_id="{{ $reply->id }}" {{ Auth::guard('admin')->user()?'':'disabled' }}>Hide</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2 border-0 subReply" id="subReply-{{ $reply->id }}">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Reply
                                    </h3>
                                    <form action="{{ route('reply.store') }}" method="post">@csrf
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                <textarea name="message" id="" cols="30" rows="5" placeholder="Reply message" class="form-control shadow"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input type="submit" value="Reply" class="btn btn-success" {{ Auth::guard('web')->user()?'':'disabled' }}>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach($reply->subreplies as $subreply)
                            <div class="card card-body mb-2" id="reply-{{ $subreply->id }}" style="left: 100px; display: inline-block; padding-right: 0;margin-right: 98px !important;">
                                <div class="row">
                                    <div class="card-text col-md-9">
                                        <h5 class="p-0">{{ $subreply->name }}</h5>
                                        <p class="p-0">{{ date('M d,Y',strtotime( $subreply->created_at)) }}</p>
                                        <p class="p-0">{{ $subreply->message }} by {{ $subreply->name }}</p>
                                    </div>
                                    <div class="col-md-3 mt-5">
                                        <div class="btn-group">
                                            <button class="btn btn-success replyHide" reply_id="{{ $subreply->id }}" {{ Auth::guard('admin')->user()?'':'disabled' }}>Hide</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">
        <!-- Search Widget -->
    </div>
@endsection
