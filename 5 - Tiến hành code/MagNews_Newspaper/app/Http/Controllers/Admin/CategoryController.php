<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Session;
use DataTables;
use Validator;


class CategoryController extends Controller
{
    // Lấy danh sách danh mục - category cho trang danh sách 
    public function getList()
    {
    	$category = new Category();
        $parents = $category->getParents();
    	return view('admin.category.list',["cates"=>$parents]);
    }

    // Lấy danh sách - danh mục cha - cho thêm danh mục 
    public function getAdd()
    {
        $category = new Category();
        $parents = $category->getParents();
    	return view('admin.category.add',['cates'=>$parents]);
    }

    // Thêm danh mục mới 
    public function postAdd(Request $request)
    {
        $categoryrequest = new CategoryRequest();
        $validator = Validator::make($request->all(),$categoryrequest->rules(), $categoryrequest->messages());
        
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $cate = new Category();
            $cate->name_category = $request->input('cate_name');
            $cate->slug_category = $request->input('slug');
            if( $request->input('parent_id') )
            {
                $parent_id = Category::find($request->input('parent_id'));
                if( $parent_id )
                {
                    $cate->parent_id = $request->input('parent_id');
                }
            }
            $cate->save();
            Session::flash('flash_success','Thêm danh mục thành công.');
            return redirect('admin/category/add');
        }
    	
    	
    }

    // Dữ liệu bảng danh mục 
    public function dataTable()
    { 
    	$model = Category::query();
    	return DataTables::eloquent($model)->addColumn('post_count', function(Category $cate1) 
        {
            return $cate1->posts->count().' bài viết';
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

    // Cập nhật danh mục 
    public function postUpdate(Request $request)
    {
        $categoryrequest = new CategoryRequest();
        $validator = Validator::make($request->all(),$categoryrequest->rules_update(), $categoryrequest->messages_update());
        
        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else
        {
            if($request->ajax())
            {
                $cate = Category::find($request->input('id'));
                if( $cate ) 
                {
                    $cate->name_category = $request->input('cate-name');
                    $cate->slug_category = $request->input('slug');
                    if( $parent_id = $request->input('parent') )
                    {
                        $cate->parent_id = $parent_id;
                    }
                    $cate->save();
                    return 'ok';
                } 
                else 
                    return response()->json(['errors'=>'Sai ID']);
            }
        }
    	
    }

    // Xóa danh mục 
    public function delete(Request $request)
    {
    	if($request->ajax()){
    		$cate = Category::find($request->input('id'));
    		if( $cate ) 
            {
    			$cate->delete();
    			return 'ok';
    		} 
            else 
                return 'err';
    	}
    }
}

