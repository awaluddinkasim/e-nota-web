<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth');
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? 'true' : 'false';

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
            if (Auth::user()->role == "super-admin") {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->toko) {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();

                return redirect()->back()->with('failed', 'Akun anda belum terdaftar pada toko tertentu');
            }
        }
        return redirect()->back()->with('failed', 'Username atau password salah');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function loginAPI(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth-token")->plainTextToken;

                return response()->json([
                    'message' => 'Berhasil',
                    'token' => $token,
                    'user' => $user
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Username atau password salah',
        ], 401);
    }

    public function logoutAPI(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil'
        ], 200);
    }
}
