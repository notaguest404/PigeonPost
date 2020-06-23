<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Rule;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user',$user));
    }

    public function profileview($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile',compact('user',$user));
    }

    public function update_avatar(Request $request, user $user){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->update($request->all());
        $user->save();

        return back();

    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit( User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|',
        ]);

        // if fails redirects back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Fill user model
        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Save user to database
        $user->save();

        // Redirect to route
        return back();
    }
}
