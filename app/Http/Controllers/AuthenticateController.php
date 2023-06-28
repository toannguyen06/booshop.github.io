<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UsersInformation;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function showLogin (){
        $categories = Category::all();
        return view('frontend.auth.login', compact('categories'));
    }

    public function login (Request $request){
        $validated = $request->validate([
            'email' => 'bail|required|email',
            'password' => 'required'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if ($validated){
            if (Auth::attempt(['email' => $email, 'password' => $password])){
                return redirect('/');
            } else {
                $request->session()->flash('fail', 'Email hoặc mật khẩu không chính xác');
                return redirect('/login')->withInput();
            }
        }
    }

    public function showRegister (){
        $categories = Category::all();
        return view('frontend.auth.register', compact('categories'));
    }

    public function register (Request $request){
        $validated = $request->validate([
            'email' => 'bail|required|email|unique:users',
            'password' => 'required',
            're-password' => 'required|same:password',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::create(['email' => $email, 'password' => $password, 'role' => 3]);
        UsersInformation::create(['user_id' => $user->id]);
        $user->information->update($request->input());
        return redirect('/login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function changePassword() {
        $categories = Category::all();
        return view('frontend.me.change_password', compact('categories'));
    }

    public function updatePassword(Request $request) {

        if(Hash::check($request->input('old_pass'),  Auth::user()->password )){
            if ($request->input('new_pass') == $request->input('re_new_pass')) {
                Auth::user()->update(['password' => $request->input('new_pass')]);
                return json_encode(['state' => 1]);
            } else {
                return json_encode(['state' => 0, 'error' => 'Nhập lại mật khẩu không chính xác']);
            }
        } else {
            return json_encode(['state' => 0, 'error' => 'Mật khẩu cũ không chính xác']);
        }
    }
}


