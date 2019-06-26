<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_tag extends Model
{
    protected $fillable = [
    	'id',
        'post_id',
        'tag_id',
    ];
    protected $table = 'post_tag';
    protected $primarykey = 'id';
}
