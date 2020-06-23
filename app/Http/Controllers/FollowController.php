<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as resend;

class FollowController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::where('id', '!=', Auth::id())->get()
        ]);
    }


    public function follow(User $user)
    {
        if (!Auth::user()->isFollowing($user->id)) {
            // Create a new follow instance for the authenticated user
            Auth::user()->follows()->create([
                'target_id' => $user->id,
            ]);

            return redirect('/posts');
        } else {
            return redirect('/posts');
        }

    }

    public function unfollow(User $user)
    {
        if (Auth::user()->isFollowing($user->id)) {
            $follow = Auth::user()->follows()->where('target_id', $user->id)->first();
            $follow->delete();

            return redirect('/posts');
        } else {
            return redirect('/posts');
        }
    }
}
