<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    
    public function getLogin(){
    	if(Auth::check()){
    		return redirect()->intended('/');
    	}
    	return view('login');
    }
    public function postLogin(Request $request){
    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	];
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 kí tự',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()){
    		return redirect()->back()->withErrors($validator)->withInput();
    	}else{
    		$email = $request->input('email');
    		$password = $request->input('password');
    		if(Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember'))){
                if(Auth::user()->delete_flg == 1){
                   Auth::logout();
                   return view('errors.error_login'); 
                }
    			return redirect()->intended('/');
                // return redirect()->back();
    		}else{
    			$errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng!']);
    			return redirect()->back()->withErrors($errors)->withInput();
    		}
    	}
    }
    public function getLogout(){
        Auth::logout();
            return redirect('/');
        
    }
}
