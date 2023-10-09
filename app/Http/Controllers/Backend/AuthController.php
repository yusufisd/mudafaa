<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\LoginLog;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function login_post(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email boş bırakılamaz!',
                'email.email' => 'Email tipi yanlış!',
                'password.required' => 'Şifre boş bırakılamaz!',
            ],
        );

        if (Admin::where('email', $request->email)->first() != null) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $auth = Auth::guard('admin')->user();
                LoginLog::create([
                    'user' => $auth->name . ' ' . $auth->surname,
                    'description' => 'Başarılı Giriş',
                ]);
                return redirect()->route('admin.index');
            } else {
                $auth = Admin::where('email', $request->email)->first();
                LoginLog::create([
                    'user' => $auth->name . ' ' . $auth->surname,
                    'description' => 'Başarısız Giriş',
                    'success' => 0,
                ]);
                return back()->withErrors('Email veya şifre yanlış');
            }
        } elseif (UserModel::where('email', $request->email)->first() != null) {
            if (Auth::guard('user_model')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $auth = Auth::guard('user_model')->user();
                LoginLog::create([
                    'user' => $auth->name . ' ' . $auth->surname,
                    'description' => 'Başarılı Giriş',
                ]);
                return redirect()->route('admin.index');
            } else {
                $auth = UserModel::where('email', $request->email)->first();
                LoginLog::create([
                    'user' => $auth->name . ' ' . $auth->surname,
                    'description' => 'Başarısız Giriş',
                    'success' => 0,
                ]);
                return back()->withErrors('Email veya şifre yanlış');
            }
        } else {
            return back()->withErrors('Böyle bir kullanıcı yok');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->user() != null) {
            $auth = Auth::guard('admin')->user();
            Auth::guard('admin')->logout();
            LoginLog::create([
                'user' => $auth->name . ' ' . $auth->surname,
                'description' => 'Çıkış Başarılı',
            ]);
        }
        else{
            $auth = Auth::guard('user_model')->user();
            Auth::guard('user_model')->logout();
            LoginLog::create([
                'user' => $auth->name . ' ' . $auth->surname,
                'description' => 'Çıkış Başarılı',
            ]);
        }

        return redirect()->route('admin.login');
    }
}
