<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        // Modificar el Request
        $request->request->add(['username' =>  Str::slug($request->username)]);

        // Validacion
        $this->validate($request, [
            'name' => 'required|max:20',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' =>$request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Auntenticar un usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Otra forma de auntenticar
        // auth()->attempt($request->only('email', 'password));

        //Redirrecionar
        return redirect()->route(['posts.index']);
    }
}
