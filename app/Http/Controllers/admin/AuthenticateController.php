<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{
    public function showLoginForm () {
        return view('backend.auth.login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'bail|required|email',
            'password' => 'required'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if ($validated){
            if (Auth::attempt(['email' => $email, 'password' => $password])){
                return redirect('/admin');
            } else {
                $request->session()->flash('fail', 'Email hoặc mật khẩu không chính xác');
                return redirect('/admin/login')->withInput();
            }
        }
        
    }

    public function logout() {
        Auth::logout();
        return redirect('/admin/login');
    }
    
    public function changePassword() {
        return view('backend.me.change_password');
    }

    public function updatePassword(Request $request) {
        
        if(Hash::check($request->input('old_pass'),  Auth::user()->password )){
            if ($request->input('new_pass') == $request->input('re_new_pass')) {
                Auth::user()->update(['password' => $request->input('new_pass')]);
                return redirect('admin/profile');
            } else {
                $request->session()->flash('errors', 'Nhập lại mật khẩu không chính xác');
                return redirect('/admin/changepassword');
            }
        } else {
            $request->session()->flash('errors', 'Mật khẩu cũ không chính xác');
            return redirect('/admin/changepassword');
        }
    }
}
