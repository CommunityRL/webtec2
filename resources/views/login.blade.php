@extends('layout.layout')

@section('content')
    <div style="border: 2px solid black">
        <h2>Login</h2>
        <form action="/loginAction" method="POST">
            @csrf
            <input name="loginName" type="text" placeholder="name">
            <input name="loginPassword" type="password" placeholder="password">
            <button>Login</button>
        </form>
    </div>
@endsection
