@extends('layout.layout')
@section('content')
    @foreach ($posts as $post)
        <div class="mt-3">
            @include('shared.post-displayer')
        </div>
    @endforeach
@endsection
