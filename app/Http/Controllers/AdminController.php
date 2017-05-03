<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $users = DB::table('users')->where('delete_flg', '0')->get();
        $admins = array();
        $managers = array();
        $restaurants = array();
        $branchs = array();
        $shippers = array();
        $shoppers = array();
        foreach ($users as $user) {
            if($user->role == 5){
                array_push($admins, $user);
            }
            if($user->role == 4){
                array_push($managers, $user);
            }
            if($user->role == 3){
                array_push($restaurants, $user);
            }
            if($user->role == 2){
                array_push($branchs, $user);
            }
            if($user->role == 1){
                array_push($shippers, $user);
            }
            if($user->role == 0){
                array_push($shoppers, $user);
            }
        }
        $posts = DB::table('posts')->where('delete_flg', '0')->get();
        return view('admin.index', compact('admins','managers','restaurants','branchs','shippers','shoppers','posts'));
        // return view('admin.index', ['shoppers' => $shoppers],['posts' => $posts]); chỉ trả về được 2 mảng
    }
}
