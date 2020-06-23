<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Posts;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function global()
    {
        $posts = Posts::latest()->paginate(5);
        return view('global', compact('posts'));
    }

    public function data()
    {
        $posts = Posts::latest();
        return view('data', compact('posts'));
    }


    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return view('posts.show', compact('post'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required|max:255',
            'description'  => 'required',

        ]);

        $request->validate([
            'postpic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->has('postpic')) {
            $imageName = rand().'_post'.time().'.'.request()->postpic->getClientOriginalExtension();
            $request->postpic->storeAs('posts',$imageName);
        }
        else{
            $imageName ='null';
        }


        Posts::create([
            'title'     => $request->input('title'),
            'description' => $request->input('description'),
            'user_id'   => Auth::user()->id,
            'postpic' => $imageName,
        ]);

        return redirect('/posts');
    }

    public function edit(Posts $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Posts $post)
    {
        $this->validate($request, [
            'title'       => 'required|max:255',
            'description' => 'required',
        ]);
        $request->validate([
            'postpic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->has('postpic')) {
            $imageName = rand().'_post'.time().'.'.request()->postpic->getClientOriginalExtension();
            $request->postpic->storeAs('posts',$imageName);
        }
        else{
            $imageName = $post->postpic;
        }

        $post->update($request->all());
        $post->postpic = $imageName;
        $post->save();
        return view('posts.show', compact('post'));
    }

    public function destroy(Posts $post)
    {
        $post->delete();
        return redirect('/posts');
    }

}
