<div class="d-flex align-items-start">
    {{--commenters profile picture--}}
    <div class="w-100">
        <div class="d-flex justify-content-between">
            <h6 class="">{{--commenter--}}
            </h6>
            <small class="fs-6 fw-light text-muted"> {{$comment->created_at}}</small>
        </div>
        <p class="fs-6 mt-3 fw-light">
            {{$comment->body}}
        </p>
    </div>
</div>