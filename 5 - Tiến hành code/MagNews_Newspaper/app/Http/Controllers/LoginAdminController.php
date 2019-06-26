<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests\LoginRequest;
use App\Models\Category;
use Validator;
use Auth;
use App\Rules\Captcha;

class LoginAdminController extends Controller
{

    public function getLogin()
    {
      $category = new Category();
    	if(Auth::check())
    	{
    		return redirect()->route('dashboard');
    	}
    	return view('news.pages.login'); 
    }

    // Đăng nhập 
    public function postLogin(Request $request)
   	{
   		$loginrequest = new LoginRequest();
   		$validator = Validator::make($request->all(),$loginrequest->rules(), $loginrequest->messages());
   		
   		if($validator->fails())
   		{
   			return redirect()->back()->withErrors($validator)->withInput();
   		}
   		else
   		{
   			$email = $request->input('email');
        	$password = $request->input('password');

        	if( Auth::attempt(['email' => $email, 'password' => $password], $request->input('remember_token') ) )
        	{
        		return redirect()->route('dashboard');
        	} 
        	else 
        	{
        		$msg = new MessageBag(['errlogin'=> 'Tên đăng nhập hoặc mật khẩu không đúng ! Vui lòng kiểm tra lại !']);
        		return redirect()->back()->withErrors($msg);
        	}

   		}
    }


    // Đăng xuất 
    public function getLogout()
    {
        if( Auth::check()) 
        	Auth::logout();
        return redirect()->route('login-page');
    }
}
