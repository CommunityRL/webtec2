@auth
    
<h4>Create Post</h4>
<div class="row">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" placeholder="Title" name="title">
            <textarea name="body" class="form-control" id="idea" rows="3"></textarea>
            @error('title')
            <span class="fs-6 text-danger">{{ $message }}</span>
            @enderror
            @error('body')
            <span class="fs-6 text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="">
            <button type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
@endauth
@guest
    <h4>Login to Post</h4>
@endguest