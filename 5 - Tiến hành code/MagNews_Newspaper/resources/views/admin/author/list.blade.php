@extends('admin.layouts.layout')
@section('content')     
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Author
                    <small>Danh Sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="form-group">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#show-add">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Author
                </button>
            </div>

            <!-- #Taglist -->
            <table class="table table-striped table-bordered table-hover" id="tag_list">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ngày Sinh</th>
                        <th>Số Bài Viết</th>
                        <th>Tạo Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Modal Add-->
<div class="modal fade" id="show-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Thêm tác giả </h4>
        </div>
        <div class="modal-body">
            <form id="form-add">
                {{ csrf_field() }}
                <!-- Thông báo lỗi  -->
                <div class="alert alert-danger" style="display:none"></div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tên</label>
                    <input type="text" class="form-control" id="authorname" name="authorname">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Mật Khẩu</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- Modal Delete-->
<div class="modal fade" id="show-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Xóa Author</h4>
        </div>
        <div class="modal-body">
            <form id="form-delete">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="del-id">
                <p>Bạn có chắc muốn xóa <strong id="del-name"></strong> cũng như các bài viết của họ ?</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete">Xóa</button>
            </div>
            </form> 
        </div>
    </div>
  </div>
</div>

@endsection
@section('script')
 <!-- DataTables JavaScript -->
 <script type="text/javascript">
    $(document).ready(function() {
        /* Get datatable from  route('data') */
        var datatable = $('#tag_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('data-author') !!}', // ajax chạy từ route với name = data-author 
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'birthday', name: 'birthday' },
                { data: 'post_count', name: 'post_count' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
            ]
        });
        /* Bind cate name to modal*/
        $('#show-delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var currentRow = button.closest("tr");
            var id=currentRow.find("td:eq(0)").text(); 
            var name=currentRow.find("td:eq(1)").text(); 
            var modal = $(this);
            modal.find('.modal-body #del-name').html(name);
            modal.find('.modal-body #del-id').val(id);
        });


        /* Gửi yêu cầu delete */
        $("#form-delete").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                url: 'admin/author/delete',
                type: 'delete',
                data: $(this).serialize(),
            })
            .done(function(data) {
                if(data==='ok'){
                    datatable.ajax.reload();
                    $('#show-delete').modal('hide');
                    $.alert("Xóa Thành Công",{
                        autoClose: true,  closeTime: 3000, type: 'success',
                        position: ['top-right', [45, 30]],
                        withTime: 200,
                        title: 'Thành Công', // title
                        icon: 'glyphicon glyphicon-ok',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                    });
                } else {
                    datatable.ajax.reload();
                    $('#show-delete').modal('hide');
                    $.alert(data,{
                        autoClose: true,  closeTime: 3000, type: 'danger',
                        position: ['top-right', [50, 30]],
                        withTime: 200,
                        title: 'Có lỗi đã xảy ra.', // title
                        icon: 'glyphicon glyphicon-remove',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                    });
                }
            })
            .fail(function() {
                datatable.ajax.reload();
                    $('#show-delete').modal('hide');
                    $.alert(data,{
                        autoClose: true,  closeTime: 3000, type: 'danger',
                        position: ['top-right', [50, 30]],
                        withTime: 200,
                        title: 'Có lỗi đã xảy ra.', // title
                        icon: 'glyphicon glyphicon-remove',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                });
            })
        });

        
        // Thêm tác giả 
        $("#form-add").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                url: 'admin/author/add',
                type: 'post',
                data: $(this).serialize(),
            })
            .done(function(data) {
                if(data ==='ok')
                {
                    datatable.ajax.reload();
                    $('#show-add').modal('hide');
                    $.alert("Thêm Thành Công",{
                        autoClose: true,  closeTime: 3000, type: 'success',
                        position: ['top-right', [45, 30]],
                        withTime: 200,
                        title: 'Thành Công', // title
                        icon: 'glyphicon glyphicon-ok',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                    });
                } 
                else 
                {
                    datatable.ajax.reload();
                    $.alert(data.errors,{
                        autoClose: true,  closeTime: 7000, type: 'danger',
                        position: ['top-right', [500, 30]],
                        withTime: 200,
                        title: 'Kiểm tra lại thông tin.', // title
                        icon: 'glyphicon glyphicon-remove',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                    });
                }
            })
            .fail(function() {
                datatable.ajax.reload();
                    $('#show-add').modal('hide');
                    $.alert("Có Lỗi",{
                        autoClose: true,  closeTime: 3000, type: 'danger',
                        position: ['top-right', [50, 30]],
                        withTime: 200,
                        title: 'Có lỗi đã xảy ra.', // title
                        icon: 'glyphicon glyphicon-remove',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                });
            })
            $('#authorname').val('');
            $('#password').val('');
            $('#email').val('');
        });
    });
 </script>
   <script src="vendor/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
   <script src="vendor/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
   <script src="js/bootstrap-flash-alert.js"></script>
@endsection
