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
    	$food_types = DB::table('food_type_details')->get();
    	$foods = Food::where('delete_flg','!=',1)->orderBy('updated_at','desc')->limit(9)->get();
    	$posts = Post::where('delete_flg','!=',1)->orderBy('updated_at','desc')->limit(9)->get();
    	return view('homepage', compact('food_types','foods','posts'));
    }
}
