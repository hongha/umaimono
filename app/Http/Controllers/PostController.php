<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('user');
 //    }
    public function create(){
    	if(Auth::check()){
            $slugs = DB::table('posts')->pluck('slug');
    		return view('post/create')->with(compact('slugs'));
    	}
    	return redirect('login');	
    }
    public function store(Request $request){
        //create with eloquent in laravel
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = $request->input('slug');
        $post->user_id = Auth::user()->id;
        $post->save();

        //create with query builder
        // $title = $request->input('title');
        // $content = $request->input('content');
        // $user_id = Auth::user()->id;
        // $slug = 'hongha';
        // DB::table('posts')->insert(
        //     ['title' => $title, 'content' => $content, 'user_id' => $user_id, 'slug' => $slug]
        // );
        return redirect('/');
    	
    }
    public function edit($id){
        $post = Post::find($id);
        return view('post.edit', compact('post'));
        // return view('post.edit')->with('post', $post); có thể trả về theo cách này
    }
    public function update(Request $request){
        var_dump($request);
    }
}
