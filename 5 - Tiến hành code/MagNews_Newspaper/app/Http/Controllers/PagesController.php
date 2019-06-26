<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PagesController extends Controller
{
	public function __construct(){
		$this->data_view = [
			'test' =>'array',
		];
	}

    public function getHome()
    {
    	$category = new Category();	
        $parents = $category->getParents();
        $parents = $category->getChilds($parents);

        $post = new Post();
    	$posts = $post->getData_Post();

    	$this->data_view = array_merge($this->data_view,[
    		'posts' => $posts,
            'dataMenu'=>$parents,

    	]);
    	return view('news.pages.home',$this->data_view);
    }


    // Route xử lý về trang danh sách post của danh mục 
    public function getCategory_Post($slug)
    {
        $post = new Post();
        $category = new Category();

        $cate = $category->getCategory_from_slug($slug); 
        
        if(!$cate)  
        {
            return view('news.pages.category',['key'=>$slug]);
        }
        else 
        {
            if($cate->parent_id == NULL) 
            {
                $parents = $category->getChilds_category($cate->id); 
                if(count($parents) > 0)
                {
                    $posts = $category->getData_Post_Parent_Category($cate->id);
                    if($posts->count() > 0)
                    {   
                        return view('news.pages.category',['posts'=>$posts,'cate'=>$cate->name_category]);
                    }
                    else
                    {
                        return view('news.pages.category',['key'=>$slug]);
                    }
                }
                else
                {
                    $posts = $post->getData_Post_Category($cate->id);
                    return view('news.pages.category',['posts'=>$posts,'cate'=>$cate->name_category]);
                }
            }
            else 
            {
                if( count($cate->posts) == 0)
                {
                    return view('news.pages.category',['key'=>$slug]);
                }
                else
                {
                    $posts = $post->getData_Post_Category($cate->id);
                    return view('news.pages.category',['posts'=>$posts,'cate'=>$cate->name_category]);
                }
            }
        }
    }



    // Route xử lý bài đăng chi tiết 
    public function getPost_Detail($slug)
    {

        $posts = new Post();
        $slug_post = $posts->getSlug_Post($slug);
        if($slug_post->count() == 0)
        {
            return view('news.pages.detail_post',['key'=>$slug ]);
        }
        else
        {
            $post = $posts->getDetail_Post($slug);
            if($post->count() == 1 )
            {
                return view('news.pages.detail_post',['key'=>$post ]);
            } 
            else
            {
                $post_relative = $posts->getPost_Relative($slug , $post->category_id);
                $post->view = $post->view + 1;
                $post->save();
                return view('news.pages.detail_post',['post'=>$post , 'post_relative'=>$post_relative]);
            }
        }
        
    }

    // Route xử lý trang tag 
    public function getTag_Post($key)
    {
        $tag_post = new Tag();
        $tag = $tag_post->getTag_Post($key);
        return view('news.pages.tag',['tag'=> $tag , 'key'=> $key]);
    }

    // Route trang tìm kiếm 
    public function getSearch(Request $request)
    {
        $posts = new Post();
        $key = $request->input('search');
        $post = $posts->getSearch_Post($key);
        return view('news.pages.search',['posts'=>$post,'key'=>$key]);
    }

    // Lấy những bài đăng của tác giả 
    public function getAuthor($user)
    {
        $author = Users::where('name',$user )->first();
        if($author->count()==0 || count($author->posts)==0){
            return view('news.pages.author',['key'=>$user]);
        } else 
        return view('news.page.author',['author'=>$author]);
    }

    // Route trang liên hệ - giới thiệu 
    public function getContact()
    {
        return view('news.pages.contact');
    }

    public function getAboutus()
    {
        return view('news.pages.aboutus');
    }
}
