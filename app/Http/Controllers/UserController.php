<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{
    public function loginAction(Request $request){
        $incomingFields = $request->validate([
            'loginName' => 'required',
            'loginPassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginName'], 'password' => $incomingFields['loginPassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
    public function registerAction(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
}