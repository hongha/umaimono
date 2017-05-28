<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Food;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $admins = User::where('delete_flg', '0')->where('role','5')->orderBy('id', 'DESC')->paginate(10);
        $managers = User::where('delete_flg', '0')->where('role','4')->orderBy('id', 'DESC')->paginate(10);
        $restaurants = User::where('delete_flg', '0')->where('role','3')->orderBy('id', 'DESC')->paginate(10);
        $shippers = User::where('delete_flg', '0')->where('role','1')->orderBy('id', 'DESC')->paginate(10);
        $shoppers = User::where('delete_flg', '0')->where('role','0')->orderBy('id', 'DESC')->paginate(10);
        $posts = DB::table('posts')->where('delete_flg', '0')->orderBy('id', 'DESC')->paginate(10);
        // $deleted_posts = DB::table('posts')->where('delete_flg', '1')->orderBy('id', 'DESC')->paginate(10);
        $foods = DB::table('foods')->where('delete_flg', '0')->orderBy('id', 'DESC')->paginate(10);
        // $deleted_foods = DB::table('foods')->where('delete_flg', '1')->where('deleted_by', '1')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.index', compact('admins','managers','restaurants','branchs','shippers','shoppers','posts','foods'));
        // return view('admin.index', ['shoppers' => $shoppers],['posts' => $posts]); chỉ trả về được 2 mảng
    }
    public function lock_post($id = null){
        $post = Post::find($id);
        $post->delete_flg = 1;
        $post->delete_at = date('y-m-d H:i:s');
        $post->delete_by = Auth::user()->id;
        $post->save();
        return response()->json($post);
    }
    public function lock_food($id = null){
        $food = Food::find($id);
        $food->delete_flg = 1;
        $food->deleted_at = date('y-m-d H:i:s');
        $food->deleted_by = Auth::user()->id;
        $food->save();
        return response()->json($food);
    }
    public function unlock_post($id = null){
        $post = Post::find($id);
        $post->delete_flg = 0;
        $post->delete_at = null;
        $post->delete_by = null;
        $post->save();
        return redirect()->back();
    }
    public function level_up($id = null){
        $shopper = User::find($id);
        $shopper->role = 4;
        $shopper->updated_at = date('y-m-d H:i:s');
        $shopper->updated_by = Auth::user()->id;
        $shopper->save();
        return redirect()->back();
    }
    public function delete_user($id = null){
        $user = User::find($id);
        $user->delete_flg = 1;
        $user->deleted_at = date('y-m-d H:i:s');
        $user->deleted_by = Auth::user()->id;
        $user->save();
        return response()->json($user);
    }
}
