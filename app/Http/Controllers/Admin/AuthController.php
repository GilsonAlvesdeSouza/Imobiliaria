<?php

namespace LaraDev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.index');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if (in_array('', $request->only('mail', 'password'))) {
            $json['message']="Informe 'Login' e 'Senha' para efetuar o login!";
            return response()->json($json);
        }

        var_dump($request->all());
    }
}
