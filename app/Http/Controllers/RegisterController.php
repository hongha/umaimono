<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use Illuminate\Support\MessageBag;
class RegisterController extends Controller
{
    protected function create(){
    	return view('register');
    }
    protected function store(Request $request){
    	$rules = [
    		'name' => 'required|min:8',
    		'email' => 'required|email|max:255|unique:users,email',
    		'password' => 'required|min:8',
    		'passwordConfirm' => 'required'
    	];
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 kí tự',
    		'name.required' => 'Username là trường bắt buộc',
    		'name.min' => 'Username phải chứa ít nhất 8 kí tự',
    		'passwordConfirm.required' => 'Phải xác nhận lại mật khẩu',
            'email.unique' => 'Email đã tồn tại!',

    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()){
    		return redirect()->back()->withErrors($validator)->withInput();
    	}else{
    		$username = $request->input('name');
    		$email = $request->input('email');
    		$password = $request->input('password');
    		$passwordConfirm = $request->input('passwordConfirm');
    		if($password != $passwordConfirm){
    			$errors = new MessageBag(['errorConfirm' => 'Mật khẩu xác nhận không đúng!']);
    			return redirect()->back()->withErrors($errors)->withInput();
    		}else{	
    			User::create([
	            'name' => $username,
	            'email' => $email,
	            'password' => bcrypt($password),
        		]);
                Auth::attempt(['email' => $email, 'password' => $password]);
    			return redirect()->intended('/');	
    		}
    	}
    	return view('register');
    }
}
