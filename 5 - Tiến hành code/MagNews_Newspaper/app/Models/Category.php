<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'id',
    	'name_category',
    	'slug_category',
    	'parent_id',
    	'created_at',
    	'updated_at'
    ];
    protected $table = 'categories';
    protected $primarykey = 'id';
    protected $timestamp = true;


    /*--------------------------------------
    | Cây menu 
    ---------------------------------------*/
    public function getParents()
    {
        $parents = self::where('parent_id',NULL)->get();
        return $parents;
    }
    public function getChilds($parents)
    {
        foreach ($parents as $key => $parent) 
        {
            $parents[$key]->childs = self::where('parent_id', $parent->id)->get();
        }
        return $parents;
    }
    public function getChildsSub($parents)
    {
        foreach ($parents as $key => $parent) 
        {
            foreach ($parents[$key]->childs as $key1 => $value) 
            {
                $parents[$key]->childs[$key1]->childsubs = self::where('parent_id', $value->id)->get();
            }
        }
        return $parents;
    }
    
    public function posts()
    {
        return $this->hasMany('App\Models\Post','category_id','id');
    }

    public function getCategory_slug($slug)
    {
        $data = Category::where('slug_category', $slug)->get('slug_category'); 
        return $data;
    }
    public function getCategory_from_slug($slug)
    {
        $data = Category::where('slug_category', $slug)->first(); 
        return $data;
    }

    public function getChilds_category($id)
    {
        $data = Category::where('parent_id', $id)->get(); 
        return $data;
    }

    public function getData_Post_Parent_Category($id_parent)
    {   
        $data = Category::where('parent_id', $id_parent)->where('status',1)
                ->join('posts','categories.id', '=', 'posts.category_id')
                ->paginate(10); 
        return $data;
    }

    
}
