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
use App\ShoppingCart;
use App\CommentPost;
use App\CommentFood;
use App\RestaurantProfile;
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
        $saved_foods = '';
        $saved_posts = '';
        $liked_posts = '';
        if(isset(Auth::user()->id)){
        $saved_foods = DB::table('saved_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $saved_posts = DB::table('saved_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        $liked_posts = DB::table('like_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        }
        $comment_posts = CommentPost::where('id_post',$id)->where('delete_flg','!=',1)->get();
        if($id == null){
            return redirect()->back();
        }else{
            // $arr_foods[] = '';
            $post = Post::find($id);
            $user = User::find($post->user_id);
            $number_total = 0;
            $price_total = 0;
            $foods = Food::where('id_restaurant', $post->user_id)->where('delete_flg','!=',1)->orderBy('ordered','DESC')->get();
            $posts = Post::where('user_id', $post->user_id)->where('delete_flg','!=',1)->orderBy('updated_at','DESC')->limit(10)->get();
            $restaurant_info = DB::table('restaurant_profiles')->where('id_restaurant','=', $user->id)->get();
            $like_nhieus = Food::where('id_restaurant', $post->user_id)->orderBy('likes','DESC')->limit(10)->get(); 
            $luu_nhieus = Food::where('id_restaurant', $post->user_id)->orderBy('saveds','DESC')->limit(10)->get(); 
            if($post->delete_flg == 1){
                return view('errors.404');
            }else{
                if (Auth::check()) {                 
                    $shopping_carts = DB::table('shopping_carts')->where('id_user','=', Auth::user()->id)->where('id_restaurant',$post->user_id)->get();
                    foreach ($shopping_carts as $shopping_cart) {
                        $number_total = $number_total + $shopping_cart->number;
                        $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
                    }
                        return view('post.view', compact('post','user','shopping_carts','number_total','price_total','restaurant_info','foods','posts','like_nhieus','saved_foods','saved_posts','liked_posts','luu_nhieus','comment_posts'));
                    }else{
                        $shopping_carts = null;
                        return view('post.view', compact('post','user','shopping_carts','number_total','price_total','restaurant_info','foods','posts','like_nhieus','saved_foods','saved_posts','liked_posts','luu_nhieus','comment_posts'));
                } 
            }
        }
    }
    public function add_food($id_food = null){
        $shopping_cart = ShoppingCart::find($id_food);
        $shopping_cart->number = $shopping_cart->number + 1;
        $shopping_cart->save();
        return response()->json($shopping_cart);   
    }
    public function add_ghi_chu($id_food = null,Request $request){
        $shopping_cart = ShoppingCart::find($id_food);
        $shopping_cart->ghi_chu = $request->ghi_chu;
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
    public function minus_food_buy($id_food = null){
        $i=0;$j=0;
        $arr_res[] = '';
        $arr_restau[] = '';
        $shopping_cart = ShoppingCart::find($id_food);
        if($shopping_cart->number <= 1){
            $shopping_cart->delete();
        }else{
            $shopping_cart->number = $shopping_cart->number - 1;
            $shopping_cart->save();
        }
        $shopping_carts = ShoppingCart::where('id_user', Auth::user()->id)->get();
        foreach ($shopping_carts as $shopping_cart) {
            if($i == 0){
                array_push($arr_res,$shopping_cart->id_restaurant);
                $i++;
            }
            if(!in_array($shopping_cart->id_restaurant, $arr_res)){
                array_push($arr_res,$shopping_cart->id_restaurant);
                $i++;
            }
        }
        array_shift($arr_res);
        foreach ($arr_res as $res) {
            $arr_restau[$j] = RestaurantProfile::where('id_restaurant',$res)->get();
            $j++;
        }
        return response()->json($arr_restau);
    }
    public function reset_menu($id = null){
        if(Auth::check()){
            $shopping_cart = DB::table('shopping_carts')->where('id_user','=', Auth::user()->id)->where('id_restaurant',$id)->delete();
            return response()->json($shopping_cart);
        }else{
          return  redirect('login'); 
        }
    }
    public function them_hang($id_food){
        $food = Food::find($id_food);
        $id = $food->id_restaurant;
        $shopping_carts = ShoppingCart::where('id_user', Auth::user()->id)->where('id_restaurant',$food->id_restaurant)->get();
        $change_item = '';
        $number_total = 0;
        $price_total = 0;
        foreach ($shopping_carts as $shopping_cart) {
            if($shopping_cart->id_food == $id_food){
                $shopping_cart->number = $shopping_cart->number + 1;
                $shopping_cart->save();
                $change_item = $shopping_cart;
            }
        }         
        if($change_item == ''){
            $shopping_cart = new ShoppingCart;
            $shopping_cart->id_user = Auth::user()->id;
            $shopping_cart->id_restaurant = $food->id_restaurant;
            $shopping_cart->id_food = $id_food;
            $shopping_cart->food_name = $food->name;
            $shopping_cart->price = $food->price;
            $shopping_cart->number = 1;
            $shopping_cart->save();
        } 
        $shopping_carts = ShoppingCart::where('id_user', Auth::user()->id)->where('id_restaurant',$food->id_restaurant)->get();
        foreach ($shopping_carts as $shopping_cart) {
            $number_total = $number_total + $shopping_cart->number;
            $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
        }
        return view('post.shoppingCart', compact('shopping_carts', 'number_total', 'price_total','id'));               
    }
    public function them_hang_buy($id_food){
        $i=0;$j=0;
        $arr_res[] = '';
        $arr_restau[] = '';
        $food = Food::find($id_food);
        $id = $food->id_restaurant;
        $shopping_carts = ShoppingCart::where('id_user', Auth::user()->id)->where('id_restaurant',$food->id_restaurant)->get();
        $change_item = '';
        $number_total = 0;
        $price_total = 0;
        foreach ($shopping_carts as $shopping_cart) {
            if($shopping_cart->id_food == $id_food){
                $shopping_cart->number = $shopping_cart->number + 1;
                $shopping_cart->save();
                $change_item = $shopping_cart;
            }
        }         
        if($change_item == ''){
            $shopping_cart = new ShoppingCart;
            $shopping_cart->id_user = Auth::user()->id;
            $shopping_cart->id_restaurant = $food->id_restaurant;
            $shopping_cart->id_food = $id_food;
            $shopping_cart->food_name = $food->name;
            $shopping_cart->price = $food->price;
            $shopping_cart->number = 1;
            $shopping_cart->save();
        } 
        $shopping_carts = ShoppingCart::where('id_user', Auth::user()->id)->get();
        foreach ($shopping_carts as $shopping_cart) {
            $number_total = $number_total + $shopping_cart->number;
            $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
            if($i == 0){
                array_push($arr_res,$shopping_cart->id_restaurant);
                $i++;
            }
            if(!in_array($shopping_cart->id_restaurant, $arr_res)){
                array_push($arr_res,$shopping_cart->id_restaurant);
                $i++;
            }
        }
        array_shift($arr_res);
        foreach ($arr_res as $res) {
            $arr_restau[$j] = RestaurantProfile::where('id_restaurant',$res)->get();
            $j++;
        }
        return view('post.shoppingCartBuy', compact('shopping_carts', 'number_total', 'price_total','arr_restau','id'));               
    }
    public function view_food($id){
        $saved_foods = '';
        $liked_foods = '';
        if(isset(Auth::user()->id)){
        $saved_foods = DB::table('saved_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $liked_foods = DB::table('like_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        }
        $comment_foods = CommentFood::where('id_food',$id)->where('delete_flg','!=',1)->get();
        // dd($comment_foods);
       if($id == null){
            return redirect()->back();
        }else{
            // $arr_foods[] = '';
            $food = Food::find($id);
            $user = User::find($food->id_restaurant);
            $number_total = 0;
            $price_total = 0;
            $like_nhieus = Food::where('id_restaurant', $food->id_restaurant)->orderBy('likes','DESC')->limit(10)->get(); 
            $luu_nhieus = Food::where('id_restaurant', $food->id_restaurant)->orderBy('saveds','DESC')->limit(10)->get(); 
            $foods = Food::where('id_restaurant', $food->id_restaurant)->where('delete_flg','!=',1)->orderBy('ordered','DESC')->get();
            $posts = Post::where('user_id', $food->id_restaurant)->where('delete_flg','!=',1)->orderBy('updated_at','DESC')->limit(6)->get();
            $restaurant_info = DB::table('restaurant_profiles')->where('id_restaurant','=', $user->id)->get();
            // $str = explode(' ', $food->name);
            // for($i=0;$i<count($str);$i++){
            //    $arr_foods[$i] = Food::where('name', 'LIKE', "%$str[$i]%")->where('delete_flg','!=',1)->orderBy('ordered','DESC')->get();
            // } 
            if($food->delete_flg == 1){
                return view('errors.404');
            }else{
                if (Auth::check()) {                 
                    $shopping_carts = DB::table('shopping_carts')->where('id_user','=', Auth::user()->id)->where('id_restaurant',$food->id_restaurant)->get();
                    foreach ($shopping_carts as $shopping_cart) {
                        $number_total = $number_total + $shopping_cart->number;
                        $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
                    }
                        return view('post.view_food', compact('food','user','shopping_carts','number_total','price_total','restaurant_info','foods','posts','like_nhieus','saved_foods','liked_foods','luu_nhieus','comment_foods'));
                    }else{
                        $shopping_carts = null;
                        return view('post.view_food', compact('food','user','shopping_carts','number_total','price_total','restaurant_info','foods','posts','like_nhieus','saved_foods','liked_foods','luu_nhieus','comment_foods'));
                } 
            }
        } 
    }
    public function buy($id =null){
        $i=0;$j=0;
        $arr_res[] = '';
        $number_total = 0;
        $price_total = 0;
        if (Auth::check()) { 
            $food_types = DB::table('food_type_details')->get();
            $foods = Food::where('delete_flg','!=',1)->orderBy('updated_at','desc')->limit(10)->get();
            $posts = Post::where('delete_flg','!=',1)->orderBy('updated_at','desc')->limit(6)->get();
            $shopping_carts = DB::table('shopping_carts')->where('id_user','=', Auth::user()->id)->where('id_restaurant',$id)->get();
            foreach ($shopping_carts as $shopping_cart) {
                $number_total = $number_total + $shopping_cart->number;
                $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
                if($i == 0){
                    array_push($arr_res,$shopping_cart->id_restaurant);
                    $i++;
                }
                if(!in_array($shopping_cart->id_restaurant, $arr_res)){
                    array_push($arr_res,$shopping_cart->id_restaurant);
                    $i++;
                }
            }
            array_shift($arr_res);
            foreach ($arr_res as $res) {
                $arr_res[$j] = RestaurantProfile::where('id_restaurant',$res)->get();
                $j++;
            }
                return view('post.buy', compact('shopping_carts','number_total','price_total','foods','posts','food_types','arr_res','id'));
            }else{
                return view('login');
        } 
    }
    public function order($id = null, Request $request){
        $i = 0;
        $receipt = new Receipt;
        $receipt->id_user = Auth::user()->id;
        $receipt->receive_address = $request->address;
        $receipt->receive_address_lat = $request->lat;
        $receipt->receive_address_lng = $request->lng;
        $receipt->phone_number = $request->phone_number;
        $receipt->nguoi_nhan = $request->nguoi_nhan;
        $receipt->toltal_money = $request->tong_thanh_toan;
        $receipt->toltal_ship = $request->tong_ship;
        $receipt->receive_day = $request->receive_day;
        $receipt->receive_hour = $request->receive_hour;
        $receipt->ghi_chu = $request->ghi_chu;
        $receipt->save();
        $shopping_carts = ShoppingCart::where('id_user',Auth::user()->id)->where('id_restaurant',$id)->get();
        foreach ($shopping_carts as $shopping_cart) {
            if($i == 0){
                $id_restaurant = $shopping_cart->id_restaurant;
                $i++;
            }
            $order = new Order;
            $order->id_user = $shopping_cart->id_user;
            $order->id_restaurant = $shopping_cart->id_restaurant;
            $order->id_food = $shopping_cart->id_food;
            $order->food_name = $shopping_cart->food_name;
            $order->price = $shopping_cart->price;
            $order->number = $shopping_cart->number;
            $order->ghi_chu = $shopping_cart->ghi_chu;
            $order->id_receipt = $receipt->id;
            $order->save();
            $shopping_cart->delete();
            $food = Food::find($shopping_cart->id_food);
            $food->ordered = $food->ordered + $shopping_cart->number;
            $food->save();
        }
        $receipt->id_restaurant = $id_restaurant;
        $receipt->save();
        return redirect('/');
    }
    public function create_comment_post($id_post = null, Request $request){
        $comment_post = new CommentPost;
        $comment_post->id_user = $request->id_user;
        $comment_post->id_post = $id_post;
        $comment_post->content = $request->content;
        $comment_post->save();
        $post = Post::find($id_post);
        $post->comments = $post->comments + 1;
        $post->save();
        return response()->json($comment_post);
    }
    public function delete_comment_post($id_comment = null){
        $comment_post = CommentPost::find($id_comment);
        if($comment_post->id_user == Auth::user()->id){
            $comment_post->delete_flg = 1;
            $comment_post->save();
            return response()->json($comment_post);
        }else{
            return view('errors.503'); 
        }
    }
    public function edit_comment_post($id_comment = null, Request $request){
        $comment_post = CommentPost::find($id_comment);
        if($comment_post->id_user == Auth::user()->id){
            $comment_post->content = $request->editContent;
            $comment_post->save();
            return view('post.edit_comment_post', compact('comment_post'));
        }else{
            return view('errors.503'); 
        }
    }
    public function getResFoods($id_restaurant = null){
        $res_foods = Food::where('id_restaurant',$id_restaurant)->where('delete_flg','!=',1)->limit(3)->get();
        return response()->json($res_foods);
    }
    public function view_restaurant($id_restaurant = null){
         $saved_foods = '';
        $saved_posts = '';
        $liked_posts = '';
        if(isset(Auth::user()->id)){
        $saved_foods = DB::table('saved_foods')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_food');
        $saved_posts = DB::table('saved_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        $liked_posts = DB::table('like_posts')->where('id_user','=',Auth::user()->id)->where('delete_flg','=',0)->pluck('id_post'); 
        }
        if($id_restaurant == null){
            return redirect()->back();
        }else{
            // $arr_foods[] = '';
            $user = User::find($id_restaurant);
            $number_total = 0;
            $price_total = 0;
            $foods = Food::where('id_restaurant', $id_restaurant)->where('delete_flg','!=',1)->orderBy('ordered','DESC')->get();
            $posts = Post::where('user_id', $id_restaurant)->where('delete_flg','!=',1)->orderBy('updated_at','DESC')->limit(10)->get();
            $restaurant_info = DB::table('restaurant_profiles')->where('id_restaurant','=', $id_restaurant)->get();
            $like_nhieus = Food::where('id_restaurant', $id_restaurant)->orderBy('likes','DESC')->limit(10)->get(); 
            $luu_nhieus = Food::where('id_restaurant', $id_restaurant)->orderBy('saveds','DESC')->limit(10)->get(); 
            if (Auth::check()) {                 
                $shopping_carts = DB::table('shopping_carts')->where('id_user','=', Auth::user()->id)->where('id_restaurant',$id_restaurant)->get();
                foreach ($shopping_carts as $shopping_cart) {
                    $number_total = $number_total + $shopping_cart->number;
                    $price_total = $price_total + $shopping_cart->price*$shopping_cart->number;
                }
                    return view('post.view_restaurant', compact('user','shopping_carts','number_total','price_total','restaurant_info','foods','posts','like_nhieus','saved_foods','saved_posts','liked_posts','luu_nhieus','comment_posts'));
                }else{
                    $shopping_carts = null;
                    return view('post.view_restaurant', compact('user','shopping_carts','number_total','price_total','restaurant_info','foods','posts','like_nhieus','saved_foods','saved_posts','liked_posts','luu_nhieus','comment_posts'));
            } 
        }
    }
    public function create_comment_food($id_food = null, Request $request){
        $comment_food = new CommentFood;
        $comment_food->id_user = $request->id_user;
        $comment_food->id_food = $id_food;
        $comment_food->content = $request->content;
        $comment_food->save();
        $food = Food::find($id_food);
        $food->comments = $food->comments + 1;
        $food->save();
        return response()->json($comment_food);
    }
    public function delete_comment_food($id_comment = null){
        $comment_food = CommentFood::find($id_comment);
        if($comment_food->id_user == Auth::user()->id){
            $comment_food->delete_flg = 1;
            $comment_food->save();
            return response()->json($comment_food);
        }else{
            return view('errors.503'); 
        }
    }
    public function edit_comment_food($id_comment = null, Request $request){
        $comment_food = CommentFood::find($id_comment);
        if($comment_food->id_user == Auth::user()->id){
            $comment_food->content = $request->editContent;
            $comment_food->save();
            return view('post.edit_comment_food', compact('comment_food'));
        }else{
            return view('errors.503'); 
        }
    }
}
