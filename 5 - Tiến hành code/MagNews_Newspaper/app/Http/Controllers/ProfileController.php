<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\ProfileRequest;
use Auth;
use Session;
use Validator;


class ProfileController extends Controller
{
	// Lấy thông tin cá nhân 
    public function getProfile()
    {
    	$profile = User::find(Auth::user()->id);
        $post = new Post();
        $posts = $post->getUser_Post(Auth::user()->id);
        $post_count = Post::count();
    	return view('admin.author.profile' , ['profile'=>$profile , 'posts'=>$posts , 'post_count'=>$post_count]);
    }
    
    // Update information 
    public function profileUpdate(Request $request)
    {
        $profilerequest = new ProfileRequest();
        
        // Created validator 
    	if($request->input('name') == Auth::user()->name && $request->input('email') != Auth::user()->email )
        {
            $validator = Validator::make($request->all(),$profilerequest->rule_1(), $profilerequest->messages());
        } 
        else if($request->input('email') == Auth::user()->email && $request->input('name') != Auth::user()->name)
        {
            $validator = Validator::make($request->all(),$profilerequest->rule_2(), $profilerequest->messages());
        } 
        else if ($request->input('name') == Auth::user()->name && $request->input('email') == Auth::user()->email ) 
        {
             $validator = Validator::make($request->all(),$profilerequest->rule_3(), $profilerequest->messages());
        } 
        else {
            $validator = Validator::make($request->all(),$profilerequest->rule_4(), $profilerequest->messages());
        }

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        {
            $profile = User::find(Auth::user()->id);
            $profile->name = $request->input('name');
            $profile->email = $request->input('email');
            $profile->birthday = $request->input('birthday');
            $profile->password= bcrypt($request->input('password'));
            
            //Upload Image
            if($request->hasFile('avatar'))
            {
                $file = $request->file('avatar');
                $file_extension = $file->getClientOriginalExtension(); 
                $file_name = $file->getClientOriginalName();  
                $random_file_name = str_random(4).'_'.$file_name;
                while(file_exists('upload/profiles/'.$random_file_name))
                {
                    $random_file_name = str_random(4).'_'.$file_name;
                }
                $file->move('upload/profile',$random_file_name);
                $file_upload = 'upload/profile/'.$random_file_name;
                $profile->avatar = $file_upload;
            } 
            else $profile->avatar = '';
            
            $profile->save(); // Save
            Session::flash('flash_success','Thay đổi thành công.');
            return redirect()->back();
        }
    }
}
