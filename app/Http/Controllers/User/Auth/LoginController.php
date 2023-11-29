<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('index', 'logout');
    }
    public function index()
    {
        if (auth()->check() == true) return redirect()->route('user.dashboard.index');
        $components = [
            'page' => [
                'title' => 'Login',
                'subtitle' => 'Login'
            ]
        ];
        return view('user.auth.login', $components);
    }

    public function action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ], [], [
            'email' => 'Email',
            'password' => 'Password',
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'type' => 'validation',
                'msg' => $validator->errors()->toArray()
            ];
        }

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials) == false) {
            return [
                'status' => false,
                'type' => 'alert',
                'msg' => 'Username atau password tidak sesuai!.'
            ];
        }

        return [
            'status' => true,
            'type' => 'alert',
            'msg' => 'Login berhasil!',
            'redirect_url' => route('user.dashboard.index')
        ];
    }

    public function logout()
    {
        if (auth()->check() == false) return redirect()->route('user.auth.loginGET')->with('error', 'Harap login terlebih dahulu!');
        auth()->logout();
        return redirect()
            ->route('user.auth.loginGET')
            ->with('success', 'Berhasil logout!');
    }
}
