<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('content')) {
            $posts = Post::where('content', 'like', '%' .$request->query('content'). '%')->get();
        } else {
            $posts = Post::all();
        } 
        foreach($posts as $post) {
            $user = User::findOrFail($post->user_id);
            // print_r(json_encode($post));
            $post->user_name = $user->name;
        }
        $id = Auth::id();
        return view('timeline', compact('posts', 'id'));
    }

    public function store(Request $request) {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->content;
        $post-> save();

        return redirect('/timeline');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/timeline');
    }

    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
        $post->content =$request->content;
        $post->save();

        return redirect('/timeline');
    }
}
