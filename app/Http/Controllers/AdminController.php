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
        $users = DB::table('users')->get();
        $posts = DB::table('posts')->get();
        return view('admin.index', ['users' => $users], ['posts' => $posts]);
    }
}
