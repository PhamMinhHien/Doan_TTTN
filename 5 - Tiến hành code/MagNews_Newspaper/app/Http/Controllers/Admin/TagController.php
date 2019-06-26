<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use DataTables;
use Validator;
use App\Http\Requests\TagRequest; 


class Tagcontroller extends Controller
{
    public function getList()
    {
    	return view('admin.tag.list');
    }


    // Thêm tag 
    public function postAdd(Request $request)
    {
        $tagrequest = new TagRequest();
        $validator = Validator::make($request->all(),$tagrequest->rules(), $tagrequest->messages());

        if ($validator->fails()) 
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
        else 
        {   
            if($request->ajax())
            {
                $tag = new Tag();
                $tag->name_tag = $request->input('tag-name');
                $tag->slug_tag = $request->input('slug');
                $tag->save();
                return 'ok';
            }
        }
    }

    public function dataTable()
    { 
    	$model = Tag::query();
    	return DataTables::eloquent($model)
    			->addColumn('post_count', function(Tag $tag) {
                    return $tag->posts->count() . ' bài';
                })
                ->addColumn('action', '
                	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#show-update">
                		<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa 
                	</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#show-delete">
                    	<i class="fa fa-trash" aria-hidden="true"></i> Xoá
                    </button>')
                ->make(true);
    }

    public function putUpdate(Request $request)
    {
        $tagrequest = new TagRequest();
        $validator = Validator::make($request->all(),$tagrequest->rules_update(), $tagrequest->messages_update());

        if ($validator->fails()) 
        {
             return response()->json(['errors'=>$validator->errors()->all()]);
        } 
        else 
        {
            if($request->ajax())
            {
                $tag = Tag::find($request->input('id'));
                if( $tag ) 
                {
                    $tag->name_tag = $request->input('tag-name');
                    $tag->slug_tag = $request->input('slug');
                    $tag->save();
                    return 'ok';
                } 
                else return response()->json(['errors'=>'Sai ID']);
            }   
            
        }
   	   
    }

    public function delete(Request $request)
    {
    	if($request->ajax())
        {
    		$tag = Tag::find($request->input('id'));
    		if($tag)
            {
                $tag->posts()->detach();
                $tag->delete();
                return 'ok';
    		}
    		else return 'Không tồn tại tag.';
    	} else return 'err';
    }
}
