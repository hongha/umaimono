<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Food;
use Image;
use \Input as Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;
use App\User;
use App\ShoppingCart;
use App\RestaurantProfile;
use Illuminate\Support\Collection;
class HomeController extends Controller
{
    public function getIndex(){
    	$posts = DB::table('posts')->where('delete_flg','=',0)->orderBy('updated_at','desc')->limit(6)->get();
    	return view('index')->with(compact('posts'));
    }
    public function index(){
        $saved_foods = '';
        $saved_posts = '';
        $liked_foods = '';
        $liked_posts = '';
    	$food_types = DB::table('food_type_details')->get();
        if(isset(Auth::user()->id)){
        $saved_foods = DB::table('saved_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $saved_posts = DB::table('saved_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        $liked_foods = DB::table('like_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $liked_posts = DB::table('like_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        }
        $food_pb = Food::where('delete_flg','!=',1)->orderBy('saveds','desc')->orderBy('likes','desc')->orderBy('comments','desc')->limit(9)->get();
        $post_pb = Post::where('delete_flg','!=',1)->orderBy('saveds','desc')->orderBy('likes','desc')->orderBy('comments','desc')->limit(9)->get();
    	$foods = Food::where('delete_flg','!=',1)->orderBy('id','desc')->limit(9)->get();
    	$posts = Post::where('delete_flg','!=',1)->orderBy('id','desc')->limit(9)->get();
        $restaurant_infos = RestaurantProfile::where('address','!=',null)->where('lat','!=',0)->where('lng','!=',0)->get();;
    	return view('homepage', compact('food_types','foods','posts','saved_foods','saved_posts','liked_foods','liked_posts','restaurant_infos','food_pb','post_pb'));
    }
    public function search(Request $request){
        $saved_foods = '';
        $saved_posts = '';
        $liked_foods = '';
        $liked_posts = '';
        if(isset(Auth::user()->id)){
        $saved_foods = DB::table('saved_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $saved_posts = DB::table('saved_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        $liked_foods = DB::table('like_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $liked_posts = DB::table('like_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        }
        $foods = Food::where('delete_flg','!=',1)->where('name', 'like', '%' . $request->search . '%')->get();
        $posts = Post::where('delete_flg','!=',1)->where('title', 'like', '%' . $request->search . '%')->get();
        $restaurants = RestaurantProfile::where('delete_flg','!=',1)->where('restaurant_name', 'like', '%' . $request->search . '%')->orWhere('address','like','%' . $request->search . '%')->get();
        $food_types = DB::table('food_type_details')->get();
        return view('search_result',compact('foods','posts','food_types','restaurants','liked_foods','liked_posts','saved_foods','saved_posts'));
    }
}
