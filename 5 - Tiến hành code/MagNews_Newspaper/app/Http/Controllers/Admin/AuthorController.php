<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\AuthorRequest;
use App\Models\User;
use Validator;
use DataTables;

class AuthorController extends Controller
{
    public function getList()
    {
    	return view('admin.author.list');
    }

    public function postAdd(Request $request)
    {
        $authorrequest = new AuthorRequest();
        $validator = Validator::make($request->all(),$authorrequest->rules(), $authorrequest->messages());
        if ($validator->fails()) 
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
        else 
        {
    	    if($request->ajax())
            {
                $author = new User();
                $author->name = $request->input('authorname');
                $author->password = bcrypt($request->input('password'));
                $author->email = $request->input('email');
                $author->role == "author";
                $author->save();
                return 'ok';
            }
	    }
    }

    public function dataTable()
    { 
    	$model = User::where('role','!=','admin');
    	return DataTables::eloquent($model)
                ->addColumn('post_count', function(User $author) {
                    return $author->posts->count().' bài viết';
                })
                ->addColumn('action', '
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#show-delete">
                    	<i class="fa fa-trash" aria-hidden="true"></i> Xoá
                    </button>')
                ->make(true);
    }

    // Xóa 
    public function delete(Request $request)
    {
    	if($request->ajax())
        {
    		$author = User::find($request->input('id'));
    		if($author->delete())
            {
    			return 'ok';
    		} 
            else 
                return response()->json(['errors'=>'Không thể xóa.']);
    	}
    }
}

