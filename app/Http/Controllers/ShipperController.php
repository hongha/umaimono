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
use App\RestaurantProfile;
use Illuminate\Support\Collection;
class ShipperController extends Controller
{
	public function __construct()
    {
        $this->middleware('shipper');
    }
    public function index()
    {
    	$id_shipper = Auth::user()->id;
        $shipper_info = DB::table('shippers')->where('id_user', $id_shipper)->get();
        foreach ($shipper_info as $shipper_info) {
        }
        if($shipper_info->name == '' | $shipper_info->phone_number == ''){
            return view('shipper/edit_profile',compact('shipper_info'));
        }else{
            $shipper_info = DB::table('shippers')->where('id_user', $id_shipper)->get();
                foreach ($shipper_info as $shipper_info) {
            }
            $receipt_dangs = Receipt::where('id_shipper',$shipper_info->id)->where('delete_flg','!=',1)->where('shipping',1)->orderBy('id','desc')->get();
            $receipt_das = Receipt::where('id_shipper',$shipper_info->id)->where('delete_flg','!=',1)->where('shipping',2)->orderBy('id','desc')->get();
            return view('shipper/index', compact('receipt_mois','receipt_dangs','receipt_das','shipper_info'));
        }
    }
    public function view_receipt_detail($id_receipt = null){
        $user = User::find(Auth::user()->id);
        $orders = Order::where('id_receipt',$id_receipt)->get();
        $receipt = Receipt::find($id_receipt);
        $restaurant = RestaurantProfile::where('id_restaurant',$receipt->id_restaurant)->get();
        foreach ($restaurant as $restaurant) {}
        return view('shipper/view_receipt_detail', compact('user','orders','receipt','restaurant','shipper'));
    }
    public function update_profile(Request $request, $id = null){

        $shipper = DB::table('shippers')->where('id', $id)->update(
            ['name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'gio_giao_hang' => $request->gio_giao_hang]
        );
        return redirect('shipper/index');
    }
    public function edit_profile(){
        $id_shipper = Auth::user()->id;
        $shipper_info = DB::table('shippers')->where('id_user', $id_shipper)->get();
        foreach ($shipper_info as $shipper_info) {}
        return view('shipper.edit_profile',compact('shipper_info'));
    }
}
