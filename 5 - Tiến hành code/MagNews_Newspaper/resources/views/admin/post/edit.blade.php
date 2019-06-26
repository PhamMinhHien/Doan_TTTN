@extends('admin.layouts.layout')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Cập nhật</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:70px">
             @if(count($errors)>0)
             <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                {{ $err }}<br>
                @endforeach
            </div>
            @endif
            <form action="admin/post/update/{{$post->id}}" method="Post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->title_post }}" placeholder="Nhập Tiêu Đề">
                </div>
                 <div class="form-group">
                    <label>Đường dẫn</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ $post->slug_post }}">
                </div>
                <div class="form-group">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($cates as $id=>$catename)
                            <option value="{{$id}}">{{$catename}} </option>
                        @endforeach
                            <option value="{{$post->category_id}}"></option>}
                    </select>
                </div>
                <div class="form-group">
                    <label>Tóm Tắt</label>
                    <textarea name="des" class="form-control" rows="3">{{ $post->description_post}}</textarea>
                </div>
                <div class="form-group">
                    <label>Nội Dung</label>
                    <textarea name="content" id="demo" class="form-control ckeditor" rows="3">{{ $post->content_post}}</textarea>
                </div>
                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <input type="file" name="img_post" class="form-control">
                </div>
                <div class="form-group">
                    <label>Thẻ Tag ( cách nhau bằng khoảng trắng )</label>
                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width: 100% ; height: 200px;">
                        @foreach($tags as $id=>$tagname)
                            <option value="{{$id}}">{{$tagname}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="reset" class="btn btn-default">Làm Mới</button>
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
            </form>
        </div>
    </div>
</div>
</div>

@endsection

@section('script')
<script src="js/slug.js"></script>
<script>
    $(document).ready(function()
    {
        var options = 
        {
            filebrowserImageBrowseUrl: 'laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
            filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        CKEDITOR.replace('demo', options);
        $('#title').keyup(function(event) 
        {
            var title = $('#title').val();
            var slug = ChangeToSlug(title);
            $('#slug').val(slug);
        });
        $('.js-example-basic-multiple').select2();
        $('.js-example-basic-multiple').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
        $('#category_id').val({{$post->category_id}});
    });
</script>
<script src="js/select2.min.js"></script>
<script type="text/javascript" language="javascript" src="vendor/ckeditor/ckeditor.js" ></script>
@endsection