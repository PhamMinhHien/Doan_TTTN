<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
    	'id',
        'name_tag',
        'slug_tag',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tags';
    protected $primarykey = 'id';


    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post', 'post_tag');
    }


    public function getTag()
    {
        $data = Tag::limit(10)->get();
        return $data;
    }


    public function getTag_Post($tag)
    {
        $data = Tag::where('slug_tag',$tag)->first();
        return $data;
    }
}
