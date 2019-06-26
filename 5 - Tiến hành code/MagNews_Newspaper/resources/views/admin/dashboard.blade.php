@extends('admin.layouts.layout')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-pencil fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $num_post }}</div>
                                    <div>Bài Viết!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/post">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
        <!-- Nội dung ko hiển thị dành cho author từ đây --> 
        @if(Auth::user()->role=='admin')
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $num_cate}}</div>
                                    <div>Danh Mục!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/category">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tags fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $num_tag }}</div>
                                    <div>Thẻ Gắn Kèm!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/tag">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $num_user}}</div>
                                    <div>Người quản trị!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/author">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>  
            </div>

            <!-- Danh sách bài đăng mới  -->
            <div class="col-lg-12">
                <h2 class="page-header">Danh sách bài đăng mới từ tác giả </h2>
            </div>
            <table class="table table-striped table-bordered table-hover " id="example">
                <thead>
                    <tr align="center">
                        
                        <th>ID</th>
                        <th>Tiêu để</th>
                        <th>Nổi Bật</th>
                        <th>Trạng Thái</th>
                        <th>Tags</th>
                        <th>Danh Mục</th>
                        <th>Views</th>
                        <th>Ngày Đăng</th>
                        <th>Ảnh Chính</th>
                        <th>Tác giả</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        @if($post->users->role != "admin")
                        <tr class="odd gradeX">   
                            <td>{{ $post->id }}</td>
                            <td>
                                {{ $post->title_post }}
                            </td>
                            @if($post->hot==1)
                            <td class="text-center hot"><i  class="fa fa-check-square-o true" aria-hidden="true"> On</i></td>
                            @else
                            <td class="text-center hot"><i class="fa fa-ban false" aria-hidden="true"> Off</i></td>
                            @endif
                            @if($post->status==1)
                            <td class="text-center status"><i  class="fa fa-check-square-o true" aria-hidden="true"> On</i></td>
                            @else
                            <td class="text-center status"><i class="fa fa-ban false" aria-hidden="true"> Off</i></td>
                            @endif
                            <td>
                                @foreach($post->tags as $tag)
                                {{$tag->name_tag}} 
                                @endforeach
                            </td>
                            <td>{{ $post->category->name_category }}</td>
                            <td class="text-center">{{ $post->view }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <img src="{{$post->feture}}" width="50px">
                            </td>
                            <td>{{ $post->users->name }} </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>
    </div>
</div>
@endsection

@section('script')
     <script type="text/javascript">
        $(document).ready(function() 
        {
            $('#example').DataTable({'iDisplayLength': '50',"order": [[ 0, "desc" ]]});
            @if(Auth::user()->role=='admin')
            $('.status').css('cursor', 'pointer');
            $('.hot').css('cursor', 'pointer');

            /*Changer Status - thay đổi trạng thái được xuất hiện bài đăng hay ko */
            $('.status').click(function(event) {
                id = $(this).parent().find("td:eq(0)").text();
                var status = $(this).find('i.fa-ban').text();
                var div = $(this);
                if(status){
                    status = 1;
                } else status = 0;
                $.ajax({
                    url: 'admin/post/updateStatus',
                    type: 'Put',
                    data: {"id": id,"status":status,"_token": "{{ csrf_token() }}"},
                })
                .done(function(data) 
                {
                    if(data =='ok')
                    {
                        $.alert("Thay đổi thành công.",{
                            autoClose: true,  closeTime: 3000, type: 'success',
                            position: ['top-right', [45, 30]],
                            withTime: 200,
                            title: 'Thành Công',
                            icon: 'glyphicon glyphicon-ok',
                            animation: true,
                            animShow: 'fadeIn',
                            animHide: 'fadeOut',
                        });
                        if(status == 1){
                            div.html('<i class="fa fa-check-square-o true" aria-hidden="true"> On</i>');
                        } else  div.html('<i class="fa fa-ban false" aria-hidden="true"> Off</i>');
                    } else {
                        $.alert(data,{
                            autoClose: true,  closeTime: 3000, type: 'danger',
                            position: ['top-right', [45, 30]],
                            withTime: 200,
                            title: 'Lỗi',
                            icon: 'glyphicon glyphicon-ok',
                            animation: true,
                            animShow: 'fadeIn',
                            animHide: 'fadeOut',
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                })
            });

            /* Changer hot  - thay đổi bài đăng hot */
            $('.hot').click(function(event) {
                id = $(this).parent().find("td:eq(0)").text();
                var hot = $(this).find('i.fa-ban').text();
                var divn = $(this);
                $('.hot').css('cursor', 'pointer');
                if(hot){
                    hot = 1;
                } else hot = 0;
                $.ajax({
                    url: 'admin/post/updateHot',
                    type: 'Put',
                    data: {"id": id,"hot":hot,"_token": "{{ csrf_token() }}"},
                })
                .done(function(data) 
                {
                    if(data=='ok'){
                        $.alert("Thay đổi thành công.",{
                            autoClose: true,  closeTime: 3000, type: 'success',
                            position: ['top-right', [45, 30]],
                            withTime: 200,
                            title: 'Thành Công',
                            icon: 'glyphicon glyphicon-ok',
                            animation: true,
                            animShow: 'fadeIn',
                            animHide: 'fadeOut',
                        });
                        if(hot == 1)
                        {
                            divn.html('<i class="fa fa-check-square-o true" aria-hidden="true"> On</i>');
                        } 
                        else  
                            divn.html('<i class="fa fa-ban false" aria-hidden="true"> Off</i>');
                    } 
                    else {
                        $.alert(data,{
                            autoClose: true,  closeTime: 3000, type: 'danger',
                            position: ['top-right', [45, 30]],
                            withTime: 200,
                            title: 'Lỗi',
                            icon: 'glyphicon glyphicon-ok',
                            animation: true,
                            animShow: 'fadeIn',
                            animHide: 'fadeOut',
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                })
            });
            @endif
            $('#modal-delete').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var iddel = button.data('id')
              var modal = $(this)
              modal.find('.modal-body #del-id').html(iddel);
              modal.find('.modal-body #delete').attr('href', 'admin/post/delete/'+iddel);
            })
        });   
     </script>
    <script src="vendor/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="vendor/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="js/bootstrap-flash-alert.js"></script>
@endsection