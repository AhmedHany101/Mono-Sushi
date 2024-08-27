<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class auth_ctrl extends Controller
{
    //login page
    public function login_page()
    {
        return view('user_pages/login_page');
    }
    //register
    public function register_page()
    {
        return view('user_pages/register_page');
    }
    public function signup(Request $requst)
    {
        $requst->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $requst->name;
        $user->email = $requst->email;
        $user->password = Hash::make($requst->password);
        $user->save();

        return redirect('Login')->with('success', 'تم التسجيل بنجاح');
    }
    public function signin(Request $requst)
    {
        $requst->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $requst->email, 'password' => $requst->password])) {
            $requst->session()->regenerate();
            if (Auth::user()->role_as == env('admin')) {
                return redirect('admin/dashboard');
            } else {
                return redirect('/');
            }
        }
        return redirect()->back()->with('message2', 'خطاء في الرقم السر او البريد الالكتروني');

        //}  redirect('error'); //return back()->withErrors('passwsord','wrong email or password');

    }
    public function logout(Request $requst)
    {
        Auth::logout();
        $requst->session()->invalidate();
        $requst->session()->regenerateToken();
        return redirect('/');
    }
}
