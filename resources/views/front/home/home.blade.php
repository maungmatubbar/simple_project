@extends('front.master')
@section('content')
    <div class="container">
        <div class="row" id="post">
            @include('front.home.blog_posts')
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
