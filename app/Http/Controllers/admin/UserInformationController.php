<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\UsersInformation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class UserInformationController extends Controller
{
    public function showProfile() {
        return view('backend.me.profile');
    }

    // public function editProfile() {
    //     return view('backend.me.edit_profile');
    // }

    public function updateProfile(Request $request) {
        // $request->validate([
        //     'email' => 'bail|required|email'
        // ]);
        Auth::user()->information->update($request->input());
        return redirect('admin/profile')->withInput();
    }

    public function createProfile($userId) {
        return view('backend.user.createProfile', compact('userId'));
    }

    public function storeProfile($userId, Request $request) {
        $file = $request->file('avatar');
        if ($file){
            $data = array_merge($request->input(), ['user_id' => $userId, 'avatar' => $file->getClientOriginalName()]);
            $file->storeAs('', $file->getClientOriginalName(), 'avatars');
        } else {
            $data = array_merge($request->input(), ['user_id' => $userId]);
        }
        $user = User::find($userId);
        $user->information->update($data);
        return redirect('admin/users');
    }

    public function updateAvatar($userId, Request $request) {
        $file = $request->file('avatar');
        $user = $userId ? User::find($userId) : Auth::user();
        if (Storage::disk('avatars')->exists($user->information->avatar)) {
            Storage::disk('avatars')->delete($user->information->avatar);
        }
        $file->storeAs('', $file->getClientOriginalName(), 'avatars');
        $user->information->update(['avatar' => $file->getClientOriginalName()]);
        return back();
    }
}
