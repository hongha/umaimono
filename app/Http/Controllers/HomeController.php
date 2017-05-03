<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getIndex(){
    	return view('index');
    }
    public function userProfile(){
    	return view('userProfile');
    }
}
