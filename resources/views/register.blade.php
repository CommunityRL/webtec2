@extends('layout.layout')

@section('content')
    <div style="border: 2px solid black">
        <h2>Register</h2>
        <form action="/registerAction" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
@endsection
