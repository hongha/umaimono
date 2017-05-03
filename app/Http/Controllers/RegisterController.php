<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use Image;
use \Input as Input;
use Illuminate\Support\MessageBag;
class RegisterController extends Controller
{
    protected function create(){
    	return view('register');
    }
    protected function store(Request $request){
    	$rules = [
    		'name' => 'required|min:8|max:50',
    		'email' => 'required|email|max:255|unique:users,email',
    		'password' => 'required|min:8|max:20',
    		'passwordConfirm' => 'required',
            'role' => 'required',
    	];
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 kí tự',
            'password.max' => 'Mật khẩu không được vượt quá 20 kí tự',
    		'name.required' => 'Username là trường bắt buộc',
    		'name.min' => 'Username phải chứa ít nhất 8 kí tự',
            'name.max' => 'Username không được vượt quá 50 kí tự',
    		'passwordConfirm.required' => 'Phải xác nhận lại mật khẩu',
            'email.unique' => 'Email đã tồn tại!',
            'role.required' => 'Bạn phải chọn loại tài khoản!',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()){
    		return redirect()->back()->withErrors($validator)->withInput();
    	}else{
            $filename = '';
    		$username = $request->input('name');
    		$email = $request->input('email');
    		$password = $request->input('password');
    		$passwordConfirm = $request->input('passwordConfirm');
            $role = $request->input('role');
            $role_arr = array("0","1","2","3","4");
            var_dump($role_arr);
            var_dump($role);
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(12).".{$extension}";
                $file->move('avatar', $filename);
            }
            
            if($filename != ''){
                $avatar = $filename;
            }else{$avatar = 'noavatar.png';}
    		if($password != $passwordConfirm){
    			$errors = new MessageBag(['errorConfirm' => 'Mật khẩu xác nhận không đúng!']);
    			return redirect()->back()->withErrors($errors)->withInput();
    		}elseif (in_array($role, $role_arr))
            {
                User::create([
                'name' => $username,
                'email' => $email,
                'password' => bcrypt($password),
                'avatar' => $avatar,
                'role' => $role,
                ]);
                Auth::attempt(['email' => $email, 'password' => $password]);
                return redirect()->intended('/');
                
            }else{	
    			$errors = new MessageBag(['error_role' => 'Lỗi!Vui lòng đăng ký lại!']);
                return redirect()->back()->withErrors($errors)->withInput();	
    		}
    	}
    	return view('register');
    }

}
