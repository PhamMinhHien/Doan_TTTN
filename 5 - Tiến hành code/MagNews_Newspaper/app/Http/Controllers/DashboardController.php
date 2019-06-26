<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function getDashboard()  
    {
        $post_count = Post::count();
        $user_count = User::count();
        $tag_count = Tag::count();
        $category_count = Category::count();
        // Lấy những bài đăng chưa được xác nhận gửi qua cho admin 

        $post = new Post();
        $new_post = $post->getNew_Post();
        return view('admin.dashboard',['posts'=>$new_post ,'num_post'=> $post_count,'num_user'=>$user_count,'num_tag'=>$tag_count,'num_cate'=>$category_count]);
    }
}
