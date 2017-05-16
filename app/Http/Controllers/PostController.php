<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use Image;
use \Input as Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;
use App\User;
use App\ShoppingCart;
use Illuminate\Support\Collection;
class PostController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('user');
 //    }
    public function index()
    {
        return view('post/index');
    }
    public function create(){
    	if(Auth::check()){
            $slugs = DB::table('posts')->pluck('slug');
    		return view('post/create')->with(compact('slugs'));
    	}
    	return redirect('login');	
    }
    public function store(Request $request){
        //create with eloquent in laravel
        $filename = '';
        $post = new Post;
        $post->title = $request->input('title');
        if(Input::hasFile('file')){
            $file = Input::file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(12).".{$extension}";
            $file->move('post/avatar', $filename);
        }

        if($filename != ''){
            $avatar = $filename;
        }else{
            $avatar = 'noavatar.png';
        }
        $post->avatar = $avatar;
        $post->content = $request->input('content');
        $post->slug = $request->input('slug');
        $post->user_id = Auth::user()->id;
        $post->save();
        Session::flash('message', 'Successfully updated profile!');
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
        $slugs = DB::table('posts')->pluck('slug');
        return view('post.edit', compact('post', 'slugs'));
        // return view('post.edit')->with('post', $post); có thể trả về theo cách này
    }
    public function update($id = null, Request $request){
        $slugs = DB::table('posts')->where('id', '!=', $id)->pluck('slug');
        $slugs = json_decode(json_encode($slugs), true);
        if($id == null){
            return redirect()->back();
        }else{
            $post = Post::find($id);
            if(in_array($request->input('slug'), $slugs)){
                $errors = new MessageBag(['errorSlug' => 'Slug bị trùng! Bạn hãy nhập lại Slug mới!']);
                return redirect()->back()->withErrors($errors)->withInput();
            }else {
                $post->title = $request->input('title');
                $post->content = $request->input('content');
                $post->slug = $request->input('slug');
                $post->save();
                return redirect()->back();
            }
        }
        
    }
    public function delete($id = null){
        if($id == null){
            return redirect()->back();
        }else{
            $post = Post::find($id);
            $post->delete_flg = 1;
            $post->delete_at = date('y-m-d H:i:s');
            $post->delete_by = Auth::user()->id;
            $post->save();
            return redirect()->back();
        }
    }
    public function view($id = null){
        if($id == null){
            return redirect()->back();
        }else{
            $post = Post::find($id);
            $user = User::find($post->user_id);
            $number_total = 0;
            $price_total = 0;
               
            if($post->delete_flg == 1){
                return view('errors.404');
            }else{
                if (Auth::check()) {
                    $shopping_carts = DB::table('shopping_carts')->select('id', 'food_name', 'price','number')->where('id_user','=', Auth::user()->id)->get();
                    foreach ($shopping_carts as $shopping_cart) {
                        $number_total = $number_total + $shopping_cart->number;
                        $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
                        }
                        return view('post.view', compact('post','user','shopping_carts','number_total','price_total'));
                    }else{
                        $shopping_carts = null;
                        return view('post.view', compact('post','user','shopping_carts','number_total','price_total'));
                } 
            }
        }
    }
    public function buy($id = null){
        return view('google.buy', compact('id'));
    }
    public function add_food($id_food = null){
        $shopping_cart = ShoppingCart::find($id_food);
        $shopping_cart->number = $shopping_cart->number + 1;
        $shopping_cart->save();
        return response()->json($shopping_cart);   
    }
    public function minus_food($id_food = null){
        $shopping_cart = ShoppingCart::find($id_food);
        if($shopping_cart->number <= 1){
            $shopping_cart->delete();
        }else{
            $shopping_cart->number = $shopping_cart->number - 1;
            $shopping_cart->save();
        }
        return response()->json($shopping_cart);
    }
    public function reset_menu(){
        if(Auth::check()){
            $shopping_cart = DB::table('shopping_carts')->where('id_user','=', Auth::user()->id)->delete();
            return response()->json($shopping_cart);
        }else{
          return  redirect('login'); 
        }
    }
    public function them_hang($id_post){
        
        $shopping_carts = DB::table('shopping_carts')->select('id', 'food_name', 'price','number')->where('id_user','=', Auth::user()->id)->get();

    }
}
