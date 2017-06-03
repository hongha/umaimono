<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
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
use App\Food;
use App\Order;
use App\Receipt;
use App\FoodTypeDetail;
use App\RestaurantProfile;
class RestaurantController extends Controller
{
    public function index(){
    	$restaurant_id = Auth::user()->id;
        $restaurant_info = RestaurantProfile::where('id_restaurant', $restaurant_id)->get();
        foreach ($restaurant_info as $restaurant_i) {
        }
        if($restaurant_i->restaurant_name == '' | $restaurant_i->address == '' | $restaurant_i->lat == '' | $restaurant_i->lng == '' | $restaurant_i->phone_number == ''){
            return view('restaurant/edit_profile',compact('restaurant_i'));
        }else{
    	$slugs = DB::table('posts')->pluck('slug');
    	$posts = Post::where('user_id', $restaurant_id)->where('delete_flg','0')->paginate(10);
    	$foods = Food::where('id_restaurant', $restaurant_id)->where('delete_flg','!=',1)->paginate(10);
        $receipt_xacs = Receipt::where('id_restaurant',Auth::user()->id)->where('shipping',0)->where('thanh_toan',0)->where('xac_nhan',1)->where('delete_flg','!=',1)->get();
        $receipt_mois = Receipt::where('id_restaurant',Auth::user()->id)->where('thanh_toan',0)->where('xac_nhan',0)->where('delete_flg','!=',1)->where('shipping',0)->get();
        $receipt_toans = Receipt::where('id_restaurant',Auth::user()->id)->where('thanh_toan',1)->where('delete_flg','!=',1)->where('shipping',2)->where('xac_nhan',1)->get();
        $receipt_ships = Receipt::where('id_restaurant',Auth::user()->id)->where('thanh_toan',0)->where('xac_nhan',1)->where('delete_flg','!=',1)->where('shipping',1)->get();
    	// $restaurant_info = DB::table('restaurant_profiles')->where('id_restaurant','=', $restaurant_id)->get();
    	$food_types = FoodTypeDetail::all();
    	return view('restaurant/index', compact('posts','foods','slugs','food_types','restaurant_info','receipt_mois','receipt_toans','receipt_xacs','receipt_ships'));
        }
    }
    public function view_receipt($id_receipt = null){
        $restaurant = RestaurantProfile::where('id_restaurant',Auth::user()->id)->get();
        foreach ($restaurant as $restaurant) {}
        $orders = Order::where('id_receipt',$id_receipt)->get();
        $receipt = Receipt::find($id_receipt);
        $shippers = DB::table('shippers')->where('delete_flg','!=',1)->get();
        return view('restaurant/view_receipt', compact('orders','receipt','shippers','restaurant'));
    }
    public function view_receipt_detail($id_receipt = null){
        $restaurant = RestaurantProfile::where('id_restaurant',Auth::user()->id)->get();
        foreach ($restaurant as $restaurant) {}
        $orders = Order::where('id_receipt',$id_receipt)->get();
        $receipt = Receipt::find($id_receipt);
        $shipper = DB::table('shippers')->where('id',$receipt->id_shipper)->get();
        foreach ($shipper as $shipper) {
        }
        return view('restaurant/view_receipt_detail', compact('orders','receipt','shipper','restaurant'));
    }
    public function xac_nhan_receipt($id_receipt = null){
        $receipt = Receipt::find($id_receipt);
        $receipt->xac_nhan = 1;
        $receipt->save();
        return redirect('restaurant/index');
    }
    public function receipt_da_ship($id_receipt = null){
        $receipt = Receipt::find($id_receipt);
        $receipt->shipping = 2;
        $receipt->thanh_toan = 1;
        $receipt->save();
        return redirect('restaurant/index');
    }
    public function chose_shipper($id_receipt = null, $id_shipper = null){
        $receipt = Receipt::find($id_receipt);
        $receipt->id_shipper = $id_shipper;
        $receipt->shipping = 1;
        $receipt->save();
        return redirect('restaurant/index');
    }
    public function add_food(Request $request)
    {
    	$filename = '';
    	$food = new Food;
    	$food->name = $request->input('food-name');
    	$food->material = $request->input('material');
    	$food->price = $request->input('price');
    	$food->type = $request->input('food-type');
    	$food->create_by = Auth::user()->name;
    	$food->id_restaurant = Auth::user()->id;
        if(Input::hasFile('file')){
            $file = Input::file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(12).".{$extension}";
            $file->move('post/food_img', $filename);
        }
        if($filename != ''){
            $avatar = $filename;
        }else{
            $avatar = 'no-image.jpg';
        }
        $food->avatar = $avatar;
        $food->save();
        $response = array(
            'status' => 'success',
            'msg' => 'Food created successfully',
        );
        return redirect()->back();
    }
    public function edit_food($id = null){
    	$food = Food::find($id);
        return response()->json($food);
    }
    public function update_food($id = null, Request $request)
    {
    	$filename = '';
    	$food = Food::find($id);
    	$food->name = $request->input('food-name-edit');
    	$food->material = $request->input('material-edit');
    	$food->price = $request->input('price-edit');
    	$food->type = $request->input('food-type-edit');
    	$food->updated_at = date('y-m-d H:i:s');
        if(Input::hasFile('file')){
            $file = Input::file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(13).".{$extension}";
            $file->move('post/food_img', $filename);
        }
        if($filename != ''){
            $avatar = $filename;
        }else{
            $avatar = $food->avatar;
        }
        $food->avatar = $avatar;
        $food->save();
        return redirect()->back();
    }
    public function delete_food($id = null){
        $food = Food::find($id);
        $food->delete_flg = 1;
        $food->deleted_at = date('y-m-d H:i:s');
        $food->deleted_by = Auth::user()->id;
        $food->save();
        return response()->json($food);
    }
    public function add_post(Request $request){
        //create with eloquent in laravel
        $filename = '';
        $post = new Post;
        $post->title = $request->input('title');
        if(Input::hasFile('post-avatar')){
            $file = Input::file('post-avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(14).".{$extension}";
            $file->move('post/avatar', $filename);
        }

        if($filename != ''){
            $avatar = $filename;
        }else{
            $avatar = 'no-image.jpg';
        }
        $post->avatar = $avatar;
        $post->content = $request->input('content');
        $post->slug = $request->input('slug');
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->back();
    }

    public function edit_post($id = null){
        $post = Post::find($id);
        // $slugs = DB::table('posts')->pluck('slug');
        return response()->json($post);
    }

    public function update_post($id = null, Request $request){
    	$slugs = DB::table('posts')->where('id', '!=', $id)->pluck('slug');
        $slugs = json_decode(json_encode($slugs), true);
        if($id == null){
            return redirect()->back();
        }else{
            $post = Post::find($id);
            if(in_array($request->input('slug-edit'), $slugs)){
                $errors = new MessageBag(['errorSlug' => 'Slug bị trùng! Bạn hãy nhập lại Slug mới!']);
                return redirect()->back()->withErrors($errors)->withInput();
            }else {
            	$filename = '';
            	if(Input::hasFile('post-avatar-edit')){
	            $file = Input::file('post-avatar-edit');
	            $extension = $file->getClientOriginalExtension();
	            $filename = str_random(15).".{$extension}";
	            $file->move('post/avatar', $filename);
		        }

		        if($filename != ''){
		            $avatar = $filename;
		        }else{
		            $avatar = $post->avatar;
		        }
		        $post->avatar = $avatar;
                $post->title = $request->input('title-edit');
                $post->content = $request->input('content-edit');
                $post->slug = $request->input('slug-edit');
                $post->save();
                return redirect()->back();
            }
        }
    }
    public function delete_post($id = null){
        $post = Post::find($id);
        $post->delete_flg = 1;
        $post->delete_at = date('y-m-d H:i:s');
        $post->delete_by = Auth::user()->id;
        $post->save();
        return response()->json($post);
    }
    public function update_res_profile($id = null,Request $request){
    	$restaurant_info = RestaurantProfile::find($id);
    	$restaurant_info->restaurant_name = $request->input('restaurant_name');
    	$restaurant_info->address = $request->input('address');
    	$restaurant_info->lat = $request->input('lat');
    	$restaurant_info->lng = $request->input('lng');
    	$restaurant_info->link_website = $request->input('link_website');
    	$restaurant_info->phone_number = $request->input('phone_number');
    	$restaurant_info->introduction = $request->input('introduction');
    	$restaurant_info->save();
    	return redirect()->back();
    }
}
