@extends('admin.layouts.layout')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Bài viết 
                    <small>Thêm</small>
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
            @if(session('errfile'))
                <div class="alert alert-danger">
                    <strong>{{session('errfile')}}</strong>
                </div>
            @endif
           
            <form action="admin/post/add" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title')}}" placeholder="Nhập Tiêu Đề">
                </div>
                <div class="form-group">
                    <label>Đường dẫn</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug')}}">
                </div>
                <div class="form-group">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id">
                         @foreach($cates as $item)
                            @if(count($item->childs) > 0)
                                @for ($i = 0 ; $i < count($item->childs) ; $i++)
                                    @if($item->id === $item->childs[$i]['parent_id'])
                                        <option value="{{ $item->childs[$i]['id'] }}">{{ $item->childs[$i]['name_category'] }}</option>
                                    @endif
                                @endfor  
                            @else
                                <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tóm Tắt</label>
                    <textarea name="des" class="form-control" rows="3">{{ old('des')}}</textarea>
                </div>

                <div class="form-group">
                    <label>Nội Dung</label>
                    <textarea name="content" id="demo" class="form-control ckeditor" rows="3">{{ old('content')}}</textarea>
                </div>
                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <input type="file" name="img_post" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Thẻ Tag ( cách nhau bằng khoảng trắng )</label>
                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width: 100%">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name_tag}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="reset" class="btn btn-default fl-right">Làm Mới</button>
                <button type="submit" class="btn btn-primary fl-right">Thêm</button>
            </form>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script src="js/slug.js"></script>
<script>
    $(document).ready(function(){
        var options = {
                filebrowserImageBrowseUrl: 'laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
                filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
              };
        CKEDITOR.replace('demo', options);
        $('.js-example-basic-multiple').select2();
         $('#title').keyup(function(event) {
                var title = $('#title').val();
                var slug = ChangeToSlug(title);
                $('#slug').val(slug);
            });
    });
</script>
<link rel="stylesheet" type="text/css" href="css/select2.min.css">
<script src="js/select2.min.js"></script>
<script type="text/javascript" language="javascript" src="vendor/ckeditor/ckeditor.js" ></script>
@endsection