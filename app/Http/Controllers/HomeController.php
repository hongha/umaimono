<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function getIndex(){
    	$posts = DB::table('posts')->where('delete_flg','=',0)->orderBy('updated_at','desc')->limit(6)->get();
    	return view('index')->with(compact('posts'));
    }
    public function userProfile(){
    	return view('userProfile');
    }
}
