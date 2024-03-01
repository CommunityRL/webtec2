<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{

    public function profile(User $user){
        return view("users.profile", ["user" => $user]);
    }
    public function authenticate(Request $request){
        $incomingFields = $request->validate([
            'loginEmail' => 'required',
            'loginPassword' => 'required'
        ]);

        if (auth()->attempt(['email' => $incomingFields['loginEmail'], 'password' => $incomingFields['loginPassword']])) {
            $request->session()->regenerate();
        }

        return redirect()->route("dashboard");
    }
    public function store(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:30', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8', 'max:200'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect()->route("dashboard");
    }

    public function logout(){
        auth()->logout();
        return redirect()->route("dashboard");
    }

    public function login(){
        return view('users.auth.login');
    }
    public function register(){
        return view('users.auth.register');
    }
}
