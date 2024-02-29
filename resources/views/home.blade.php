@extends('layout.layout')

@section('content')
    @auth
        <p>Logged in!</p>
        <form action="{{route('user.logout')}}" method="POST">
            @csrf
            <button>Log out</button>
        </form>

        <div style="border: 2px solid black;">
            <h2>Create POST</h2>
            <form action="{{route("posts.store")}}" method="post">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder="body content..."></textarea>
                <button>Save Post</button>
            </form>
        </div>

        <div style="border: 2px solid black;">
            <h2>
                My Posts
            </h2>
            @foreach ($posts as $post)
                <div style="background-color: gray; padding: 10px; margin: 10px;">
                    <h3>{{ $post['title'] }} {{--by: {{ $post->user->name }}--}}</h3>
                    {{ $post['body'] }}
                    <p><a style="text-decoration: none; color:chartreuse;" href="{{route("posts.show", ["post" => $post->id])}}">Edit</a></p>
                    <form action="/posts/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <h2>Welcome</h2>
        <p>To view posts please <a id="myAnchor" href="#">Login or Register</a></p>
        <script>
            function dropDown() {
                const myAnchor = document.getElementById("myAnchor");
                const myButton = document.querySelector("body > nav > div > button");
                const myArea = document.querySelector("#navbarNav");

                myAnchor.addEventListener("click", function() {
                    if (myButton.className === "navbar-toggler" && myArea.classList.contains("show")) {
                        myButton.classList.add("collapsed");
                        myArea.classList.remove("show");
                    } else {

                        myButton.className = "navbar-toggler";
                        myButton.setAttribute("aria-expanded", true);
                        myArea.classList.add("show");
                    }
                    // console.log("working");
                });

            }
            dropDown();
        </script>
    @endauth
@endsection
