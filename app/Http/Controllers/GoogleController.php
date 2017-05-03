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

class GoogleController extends Controller
{
    public function map(){
    	
    	return view('google.map');
    }
    public function google_map(){
    	return view('google.google_map');
    }
    public function buy($id = null){
        if(Auth::check()){

            return view('google.buy', compact('id'));
        }else{
            return redirect('login');
        }
    	
    }
}
