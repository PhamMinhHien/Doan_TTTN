<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{

    protected $fillable = [
        'id',
        'title_post',
        'description_post',
        'slug_post',
        'view',
        'post_type',
        'hot',
        'status',
        'users_id',
        'category_id',
        'created_at',
        'updated_at',
        'feture'
    ];
    protected $table = 'posts';
    protected $primarykey = 'id';



    public function category()
    {
    	return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Models\Tag', 'post_tag', 'post_id', 'tag_id');
    }
    public function users()
    {
    	return $this->belongsTo('App\Models\User','users_id','id');
    }
    public function files()
    {
    	return $this->hasMany('App\Models\File', 'post_id','id');
    }

    public function getSlide_Post()
    {
        $data = Post::where('status',1)->orderBy('created_at','desc')->limit(8)->get();
        return $data;
    }
    
    public function getTab_Post_hot()
    {
        $data = Post::where('hot',1)->where('status',1)->orderBy('created_at','desc')->limit(4)->get();
        return $data;
    }

    public function getTab_Post_time()
    {
        $data = Post::where('post_type','text')->where('status',1)->orderBy('created_at','desc')->limit(4)->get();
        return $data;
    }

    public function getTab_Post_view()
    {
        $data = Post::where('view','!=',1)->where('status',1)->orderBy('view','desc')->limit(4)->get();
        return $data;
    }

    public function getFooter_PostNew()
    {
        $data = Post::where('status',1)->limit(9)->orderBy('created_at','desc')->get();
        return $data;
    }

    public function getFooter_Post()
    {
        $data = Post::where('status',1)->limit(3)->orderBy('view','desc')->get();
        return $data;
    }

    public function getData_Post()
    {
        $data = Post::where('post_type','=','text')->where('status',1)->take(12)->orderBy('posts.view','desc')
                ->join('categories','categories.id', '=', 'posts.category_id')
                ->get();
        return $data;
    }

    public function getData_Post_Category($id)
    {
        $data = Post::where('category_id',$id)->where('status',1)
                ->join('categories','categories.id', '=', 'posts.category_id')
                ->paginate(10);
        return $data;
    }

     public function getSlug_Post($slug)
    {
        $data = Post::where('status',1)->where('slug_post', $slug)->get('slug_post');
        return $data;
    }

    public function getDetail_Post($slug)
    {
        $data = Post::where('status',1)->where('slug_post', $slug)->first();
        return $data;
    }

 
    public function getPost_Relative($slug , $category)
    {
        $data = Post::where('status',1)->where('slug_post','!=', $slug)->where('category_id','=',$category)->take(5)->get();
        return $data;
    }


    public function getSearch_Post($key)
    {
        $data = Post::where('status',1)->where('title_post', 'like', '%'.$key.'%')->get();
        return $data;
    }

    public function getUser_Post($id)
    {
        $data = Post::where('users_id' , $id)->where('status',1)->paginate(20);
        return $data;
    }


    public function getPost_Popular()
    {
        $data = Post::where('view','!=',1)->where('status',1)->orderBy('created_at','desc')->limit(10)->get();
        return $data;
    }


    public function getPost_ForEmailReceive()
    {
        $data = Post::where('status',1)->limit(3)->orderBy('created_at','desc')->get();
        return $data;
    }

    public function getNew_Post()
    {
        $data = Post::where('status',0)->where('hot',0)->orderBy('created_at','desc')->get();
        return $data;
    }

}
