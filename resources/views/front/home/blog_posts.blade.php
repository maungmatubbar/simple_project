<!-- Blog Entries Column -->
<div class="col-md-8">
    <div class="my-4">
        <div class="card border-0">
            <div class="card-body p-0 d-flex justify-content-between">
                <div class="card-title">
                    All Post Page
                </div>
                <a href="{{ route('post.create') }}" target="_blank" class="btn btn-success {{Auth::guard('admin')->user()?'': 'disabled'}}">Add New</a>
            </div>
        </div>
    </div>
    <!-- Blog Post -->
    @foreach($posts as $post)
        <div class="card mb-4 shadow mb-5 bg-white rounded">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">  {{ substr(strip_tags($post->description), 0, 90) }}{{ strlen(strip_tags($post->description)) > 90 ? "...." : "" }}</p>
                <a href="{{ route('front.post.detail',['id'=>$post->id]) }}" class="btn btn-secondary float-right">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                Created By <strong>{{ $post->post_by }}</strong> {{ $post->created_at->diffForhumans() }}
            </div>
        </div>
    @endforeach
<!-- Pagination -->
    {{ $posts->links() }}
</div>
