@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.error-message')
            @include('shared.success-message')
            @include('shared.create-post')
            <hr>
            @foreach ($posts as $post)
                <div class="mt-3">
                    @include('shared.post-displayer')
                </div>
            @endforeach
            {{$posts->withQueryString()->links()}}
        </div>
        <div class="col-3">
            @include('shared.search')
            @include('shared.follow')
        </div>
    </div>
@endsection
