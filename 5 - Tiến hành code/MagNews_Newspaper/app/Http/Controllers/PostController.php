<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\File;
use Auth;
use Validator;
use Session;
use App\Http\Requests\PostRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
	// Lấy danh sách bài đăng tùy chọn - cho người dùng .
	public function getList()
	{
		$post = Post::all();
		if(Auth::user()->role == 'author'){
			$post = $post->where('users_id' , Auth::user()->id);
		}
		return view('admin.post.list', ['posts'=>$post]);
	}

    // lấy danh sách 
    public function getAddpost()
    {
        $category = new Category();
        $parents = $category->getParents();
        $parents = $category->getChilds($parents);
    	$tags = Tag::all();
    	return view('admin.post.add',['cates'=>$parents,'tags'=>$tags]);
    }

    // Thêm bài đăng mới 
    public function postAdd(Request $request)
    {
        $postrequest = new PostRequest();
        $validator = Validator::make($request->all(),$postrequest->rules(), $postrequest->messages());

		if ($validator->fails()) 
        {
		    return redirect()->back()->withErrors($validator)->withInput();
		} 
        else 
        {
	    	$post = new Post();
	    	$post->title_post = $request->input('title');
	    	$post->content_post = $request->input('content');
	    	$post->description_post = $request->input('des');
            // Nếu là tác giả đăng bài thì trạng thái tắt để admin xét duyệt
            $post->status = 0;
            if(Auth::user()->role =='admin')
            {
                $post->status = 1;
            }
	    	$post->slug_post = $request->input('slug');
	    	$post->users_id = Auth::user()->id;
	    	$post->category_id = $request->input('category_id');

	    	// Upload Image
	    	if($request->hasFile('img_post')){
	    		$file = $request->file('img_post');
	    		$file_extension = $file->getClientOriginalExtension(); // Lấy đuôi của file
	    		if($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg')
                {
	    			$post->post_type = 'text';
	    		} 
                else if($file_extension == 'mp4' || $file_extension == '3gp' || $file_extension == 'avi' || $file_extension == 'flv')
                {
	    			$post->post_type = 'video';
	    		} 
                else return redirect()->back()->with('errfile','Chưa hỗ trợ định dạng file vừa upload.')->withInput();

	    		$file_name = $file->getClientOriginalName();
	    		$random_file_name = str_random(4).'_'.$file_name;
	    		while(file_exists('upload/posts/'.$random_file_name))
                {
	    			$random_file_name = str_random(4).'_'.$file_name;
	    		}
	    		$file->move('upload/posts',$random_file_name);
	    		$post->feture = 'upload/posts/'.$random_file_name;

	    	} 
            else $post->feture='';
	    	$post->save();
	    	// Inset to table tag.
	    	$post->tags()->sync( $request->input('tags') ,false);
    	}
    	Session::flash('flash_success','Thêm bài viết thành công.');
    	return redirect()->route('list-post');
    }

    // Route chỉnh sửa bài đăng 
    public function getUpdate($id)
    {
    	$post = Post::find($id);
        if($post)
        {
            if($post->users_id == Auth::user()->id || Auth::user()->role =='admin')
            {
                $cates = Category::all();
                $cates2 = array();
                foreach ($cates as $cate) {
                    $cates2[$cate->id] = $cate->name_category;
                }
                $tags = Tag::all();
                $tags2 = array();
                foreach ($tags as $tag) {
                    $tags2[$tag->id] = $tag->name_tag;
                }
                return view('admin.post.edit',['post'=>$post,'cates'=>$cates2,'tags'=>$tags2]);
            } 
            else {
                Session::flash('flash_err','Bạn không có quyền thay đổi.');
                return redirect()->route('list-post');
            }
        }
    	else {
            Session::flash('flash_err','Lỗi thông tin bài viết !');
            return redirect()->route('list-post');
        }
    	
    }


    // Cập nhật bài đăng 
    public function postUpdate(Request $request,$id)
    {
    	$post = Post::find($id);
        if( $post ) 
        {
            $postrequest = new PostRequest();
            if($post->users_id == Auth::user()->id || Auth::user()->role == 'admin')
            {
            	if($post->slug_post == $request->input('slug'))
                {
                    $validator = Validator::make($request->all(),$postrequest->rules_1(), $postrequest->messages_1());
            	} 
                else 
                {
                	$validator = Validator::make($request->all(),$postrequest->rules(), $postrequest->messages());
                }
        		if ($validator->fails()) 
                {
        		    return redirect()->back()
        		                ->withErrors($validator)
        		                ->withInput();
        		} else {
            		$post->title_post = $request->input('title');
        	    	$post->content_post = $request->input('content');
        	    	$post->description_post = $request->input('des');
        	    	$post->slug_post = $request->input('slug');
        	    	$post->users_id = Auth::user()->id;
        	    	$post->category_id = $request->input('category_id');
                    //Upload Image
                    if($request->hasFile('img_post')){
                        ini_set('memory_limit','256M');
                        $file = $request->file('img_post');
                        $file_extension = $file->getClientOriginalExtension(); // Lấy đuôi của file
                        if($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg'){
                            $post->post_type = 'text';
                        } else if($file_extension == 'mp4' || $file_extension == '3gp' || $file_extension == 'avi' || $file_extension == 'flv'){
                            $post->post_type = 'video';
                        } else return redirect()->back()->with('errfile','Chưa hỗ trợ định dạng file vừa upload.')->withInput();

                        $file_name = $file->getClientOriginalName();
                        $random_file_name = str_random(4).'_'.$file_name;
                        while(file_exists('upload/posts/'.$random_file_name)){
                            $random_file_name = str_random(4).'_'.$file_name;
                        }
                        $file->move('upload/posts',$random_file_name);
                        $post->feture = 'upload/posts/'.$random_file_name;
                    }

                    $post->save();

        	    	if($request->input('tags')){
        	    		$post->tags()->sync( $request->input('tags') );
        	    	} else {
        	    		$post->tags()->sync( array() );
        	    	}
        	    	Session::flash('flash_success','Thay đổi thành công.');
            		return redirect()->route('list-post');
                }
            } 
            else 
            {
                Session::flash('flash_err','Bạn không có quyền thay đổi.');
                return redirect()->route('list-post');
            }
        } 
        else 
        {
            Session::flash('flash_err','Sai thông tin bài viết.');
            return redirect()->route('list-post');
        }
    }
    
	// Route cho hành động xóa bài đăng  
    public function getDelete($id)
    {
    	$post = Post::find($id);
	    	if( $post ){
                if( $post->user_id == Auth::user()->id || Auth::user()->role == 'admin' ){
                    $post->tags()->detach();
                    $post->delete();
                    Session::flash('flash_success','Xóa thành công.');
                    return redirect()->route('list-post');
                } else {
                    Session::flash('flash_err','Bạn không có quyền xóa bài.');
                    return redirect()->route('list-post');
                }
	    	} else {
	    		Session::flash('flash_err','Bài viết không tồn tại.');
	    	}
	    	return redirect()->route('list-post');
    }

    // Cập nhật trạng thái hiển thị 
    public function updateStatus(Request $request)
    {
        if($request->ajax()){
            $post = Post::find($request->input('id'));
            if( $post )
            {
                if( Auth::user()->role == 'admin' ){
                    if($request->input('status')== 0 || $request->input('status')==1 ){
                        $post->status =$request->input('status');
                        $post->save();
                        return 'ok';
                    } else { return 'Sai trạng thái.';}
                } else { return 'Bạn không đủ quyền'; }
            } else { return 'Bài viết không tồn tại.'; }
        }
    }

    // Cập nhật lại hot - bài đăng hot 
    public function updateHot(Request $request)
    {
        if($request->ajax()){
            $post = Post::find($request->input('id'));
            if( $post )
            {
                if( Auth::user()->role == 'admin' )
                {
                    if($request->input('hot')== 0 || $request->input('hot')==1 ){
                        $post->hot = $request->input('hot');
                        $post->save();
                        return 'ok';
                    } 
                    else { return 'Sai trạng thái.';}
                } 
                else { return 'Bạn không đủ quyền'; }
            } 
            else { return 'Bài viết không tồn tại.'; }
        }
    }
}
