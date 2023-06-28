<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UsersInformation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class UserController extends Controller
{


    public function index()
    {
        if (Auth::user()->role == 'Admin'){
            $users = User::where(['role' => '3'])->get();
        } else {
            $users = User::all();
        }

        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
            'point' => 'required|numeric'
        ]);

        $user = User::create($request->input());
        UsersInformation::create(['user_id' => $user->id]);
        return redirect('admin/users/'.$user->id.'/information');
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'point' => 'required|numeric'
        ]);
        if(!$request->input('password')){
            $data = [
                'role' => $request->input('role'),
                'point' => $request->input('point'),
            ];
        } else {
            $data = $request->input();
        }

        $user->update($data);
        $file = $request->file('avatar');
        if ($file){
            if (Storage::disk('avatars')->exists($user->information->avatar)) {
                Storage::disk('avatars')->delete($user->information->avatar);
            }
            $file->storeAs('', $file->getClientOriginalName(), 'avatars');
            $user->information->update(['avatar' => $file->getClientOriginalName()]);
        }

        $user->information->update($request->input());
        return redirect('admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('admin/users');
    }
}
