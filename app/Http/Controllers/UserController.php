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
use App\Order;
use App\Receipt;
use App\CommentPost;
use App\CommentFood;
use App\ShoppingCart;
use App\RestaurantProfile;
use Illuminate\Support\Collection;
class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('shopper');
    }
    public function index()
    {
    	$user = User::find(Auth::user()->id);
    	$receipts = Receipt::where('id_user',Auth::user()->id)->where('thanh_toan',0)->where('delete_flg','!=',1)->paginate(10);
    	$old_receipts = Receipt::where('id_user',Auth::user()->id)->where('thanh_toan',1)->where('delete_flg','!=',1)->where('shipping',2)->paginate(10);
    	return view('shopper.index', compact('user','receipts','old_receipts'));
    }
    public function view_receipt($id = null){
        $receipt = Receipt::find($id);
        $restaurant = RestaurantProfile::where('id_restaurant',$receipt->id_restaurant)->get();
        foreach ($restaurant as $restaurant) {}
    	$user = User::find(Auth::user()->id);
    	$orders = Order::where('id_receipt',$id)->where('delete_flg','!=',1)->paginate(10);
        if(isset($receipt->id_shipper)){
            $shipper = DB::table('shippers')->where('id',$receipt->id_shipper)->get();
            foreach ($shipper as $shipper) {}
        }else{
            $shipper = null;
        } 
    	return view('shopper.view_receipt', compact('user','receipt','orders','shipper','restaurant'));
    }
    public function edit_order(Request $request){
    	$user = User::find(Auth::user()->id);
    	if($request->options == 0){
    		$orders = Order::where('id_receipt',$request->id_receipt)->where('delete_flg','!=',1)->get();
    		return view('shopper.edit_order_food', compact('user','orders'));
    	}elseif($request->options == 1){
    		$receipt = Receipt::find($request->id_receipt);
    		return view('shopper.edit_order_info', compact('user','receipt'));
    	}else{
			return view('errors.404');
    	}
    }
    public function edit_order_food(Request $request){
    	$order = Order::find($request->id_order);
    	$receipt = Receipt::find($order->id_receipt);
    	$toltal = $order->number*$order->price;
    	$receipt->toltal_money = $receipt->toltal_money - $toltal + (int)$request->quant*$order->price;
    	$receipt->save();
    	$order->number = (int)$request->quant;
    	$order->ghi_chu = $request->ghi_chu;
    	$order->save();
    	return response()->json($order);
    }
    public function save_food($id_food = null){
    	$save_food = DB::table('saved_foods')->insert(
		    ['id_food' => $id_food, 'id_user' => Auth::user()->id]
		);
		$food = Food::find($id_food);
		$food->saveds = $food->saveds +1 ;
		$food->save();
    	return response()->json($save_food);
    }
    public function dis_save_food($id_food = null){
    	$save_food = DB::table('saved_foods')->where('id_food', $id_food)->update(['delete_flg' => 1]);
    	$food = Food::find($id_food);
		$food->saveds = $food->saveds -1 ;
		$food->save();
    	return response()->json($save_food);
    }
    public function like_food($id_food = null){
    	$like_food = DB::table('like_foods')->insert(
		    ['id_food' => $id_food, 'id_user' => Auth::user()->id]
		);
		$food = Food::find($id_food);
		$food->likes = $food->likes +1 ;
		$food->save();
    	return response()->json($like_food);
    }
    public function dis_like_food($id_food = null){
    	$like_food = DB::table('like_foods')->where('id_food', $id_food)->update(['delete_flg' => 1]);
    	$food = Food::find($id_food);
		$food->likes = $food->likes -1 ;
		$food->save();
    	return response()->json($like_food);
    }
    public function save_post($id_post = null){
    	$save_post = DB::table('saved_posts')->insert(
		    ['id_post' => $id_post, 'id_user' => Auth::user()->id]
		);
		$post = Post::find($id_post);
		$post->saveds = $post->saveds +1 ;
		$post->save();
    	return response()->json($save_post);
    }
    public function dis_save_post($id_post = null){
    	$save_post = DB::table('saved_posts')->where('id_post', $id_post)->update(['delete_flg' => 1]);
    	$post = Post::find($id_post);
		$post->saveds = $post->saveds -1 ;
		$post->save();
    	return response()->json($save_post);
    }
    public function like_post($id_post = null){
    	$like_post = DB::table('like_posts')->insert(
		    ['id_post' => $id_post, 'id_user' => Auth::user()->id]
		);
		$post = Post::find($id_post);
		$post->likes = $post->likes +1 ;
		$post->save();
    	return response()->json($like_post);
    }
    public function dis_like_post($id_post = null){
    	$like_post = DB::table('like_posts')->where('id_post', $id_post)->update(['delete_flg' => 1]);
    	$post = Post::find($id_post);
		$post->likes = $post->likes -1 ;
		$post->save();
    	return response()->json($like_post);
    }
    public function feedback(){
        $user = User::find(Auth::user()->id);
        return view('shopper.feedback', compact('user'));
    }
    public function saved(){
        $foods = DB::table('saved_foods')->where('id_user',Auth::user()->id)->where('delete_flg','!=',1)->get();
        $posts = DB::table('saved_posts')->where('id_user',Auth::user()->id)->where('delete_flg','!=',1)->get();
        $user = User::find(Auth::user()->id);
        // dd($foods);
        return view('shopper.saved', compact('foods','posts','user'));
    }
    public function comment(){
        $saved_foods = DB::table('saved_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $saved_posts = DB::table('saved_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        $food_ids = CommentFood::where('id_user',Auth::user()->id)->where('delete_flg','!=',1)->distinct()->pluck('id_food');
        $post_ids = CommentPost::where('id_user',Auth::user()->id)->where('delete_flg','!=',1)->distinct()->pluck('id_post');
        $user = User::find(Auth::user()->id);
        // dd($foods);
        return view('shopper.comment', compact('food_ids','post_ids','user','saved_foods','saved_posts'));
    }
    public function delete_receipt($id_receipt = null){
        $receipt = Receipt::find($id_receipt);
        $receipt->delete_flg = 1 ;
        $receipt->save();
        $orders = Order::where('id_receipt',$receipt->id)->get();
        foreach ($orders as $order) {
            $order->delete_flg = 1;
            $order->save();
        }
        return response()->json($receipt);
    }
    public function delete_order($id_order = null){
        $order = Order::find($id_order);
        $order->delete_flg = 1 ;
        $order->save();
        $receipt = Receipt::find($order->id_receipt);
        $orders = Order::where('id_receipt',$order->id_receipt)->where('delete_flg','!=',1)->first();
        if(count($orders)){
            $money_delete = $order->price*$order->number;
            $receipt->toltal_money = $receipt->toltal_money - $money_delete;
            $receipt->save();
            
        }else{
            $receipt->delete_flg = 1;
            $receipt->save();
        }
        return response()->json($receipt);
    }
}
