<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt="Mario Avatar">

                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.profile', ['user' => $post->user->id]) }}">
                            {{ $post->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class="d-flex flex-row">
                <a class="btn btn-primary btn-sm" href="{{ route('posts.show', ['post' => $post->id]) }}">View</a>
                @if (auth()->check())
                    @if (auth()->user()->id == $post->user_id)
                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                    </path>
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                    </path>
                                </svg></button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <h3>{{ $post->title }}</h3>
        <p class="fs-6 fw-light text-muted">
            {{ $post->body }}
        </p>
        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span>{{ $post->likes }}</a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock">
                    </span>{{ $post->created_at }}</span>
            </div>
        </div>
        <div>
            @auth
                <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="POST">
                    <div class="mb-3">
                        @csrf
                        <textarea name="body" class="fs-6 form-control" rows="1"></textarea>
                        <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
                    </div>
                </form>
            @endauth
            <hr>
            @foreach ($post->comments as $comment)
                @include('shared.comment-displayer')
            @endforeach
        </div>
    </div>
</div>
