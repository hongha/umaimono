<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('user');
    }
    public function index()
    {
    	echo "day la trang user";
    }
}
