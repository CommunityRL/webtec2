@auth
    @extends('layout.layout')
    @section('content')
        <div class="card">
            <h1>Edit Post</h1>
            <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
                @csrf
                @method('PUT')
                Title:
                <input type="text" name="title" value="{{ $post->title }}">
                <textarea name="body">{{ $post->body }}</textarea>
                <button>Save Changes</button>
            </form>
        </div>
    @endsection
@endauth
