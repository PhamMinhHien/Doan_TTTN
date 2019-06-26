@extends('admin.layouts.layout')
@section('content')     
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Tag
                    <small>Danh Sách</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="form-group">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#show-add">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Thẻ Tag
                </button>
            </div>
            <table class="table table-striped table-bordered table-hover" id="tag_list">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Đường Dẫn</th>
                        <th>Số Bài Viết</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Modal Update-->
<div class="modal fade" id="show-update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Chỉnh Sửa Tag</h4>
        </div>
        <div class="modal-body">
            <form id="form-update">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tên Tags</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" id="tag-name" name="tag-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Đường dẫn</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="save">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<!-- Modal Add-->
<div class="modal fade" id="show-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Thêm Thẻ Tag</h4>
        </div>
        <div class="modal-body">
            
            <form id="form-add">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tên Tags</label>
                    <input type="text" class="form-control" id="tag-name-add" name="tag-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Đường dẫn</label>
                    <input type="text" class="form-control" id="slug-add" name="slug">
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
            <h4 class="modal-title">Xóa Thẻ</h4>
        </div>
        <div class="modal-body">
            <form id="form-delete">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="del-id">
                <p>Bạn có chắc muốn xóa thẻ <strong id="del-name"></strong>?</p>
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
<script src="js/slug.js"></script>
 <!-- DataTables JavaScript -->
 <script type="text/javascript">
    $(document).ready(function() {
        //creat slug
         $('#tag-name').keyup(function(event) {
            var title = $('#tag-name').val();
            var slug = ChangeToSlug(title);
            $('#slug').val(slug);
        });
          $('#tag-name-add').keyup(function(event) {
            var title = $('#tag-name-add').val();
            var slug = ChangeToSlug(title);
            $('#slug-add').val(slug);
        });


        /* Bật modal */
        $('#show-delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentRow = button.closest("tr");
            var id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
            var name=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
            var modal = $(this);
            modal.find('.modal-body #del-name').html(name);
            modal.find('.modal-body #del-id').val(id);
        });

        /* Get datatable from  route('data') */
        var datatable = $('#tag_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('data-tag') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name_tag', name: 'name_tag' },
                { data: 'slug_tag', name: 'slug_tag' },
                { data: 'post_count', name: 'post_count' },
                { data: 'action', name: 'action' },
            ]
        });

        /* Bind data record to form modal*/
        $('#show-update').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentRow = button.closest("tr");
            var id=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
            var name=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
            var slug=currentRow.find("td:eq(2)").text(); // get current row 2nd TD
            var sl_name=currentRow.find("td:eq(3)").text(); // get current row 3rd TD
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #tag-name').val(name);
            modal.find('.modal-body #slug').val(slug);
        });

        /* Update*/
        $("#form-update").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                url: 'admin/tag/update',
                type: 'Put',
                data: $(this).serialize(),
            })
            .done(function(data) {
                if(data==='ok'){
                    datatable.ajax.reload();
                    $('#show-update').modal('hide');
                    $.alert("Cập Nhật Thành Công",{
                        autoClose: true,  closeTime: 3000, type: 'success',
                        position: ['top-right', [45, 30]],
                        withTime: 200,
                        title: 'Thành Công',
                        icon: 'glyphicon glyphicon-ok',
                        animation: true,
                        animShow: 'fadeIn',
                        animHide: 'fadeOut',
                    });
                } else {
                    datatable.ajax.reload();
                    $.alert(data.errors,{
                        autoClose: true,  closeTime: 3000, type: 'danger',
                        position: ['top-right', [500, 30]],
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
                    $('#show-update').modal('hide');
                    $.alert("Tag hoặc đường dẫn đã tồn tại",{
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

        
        /* XÓa*/
        $("#form-delete").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                url: 'admin/tag/delete',
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


        // Thêm tag 
        $("#form-add").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                url: 'admin/tag/add',
                type: 'Post',
                data: $(this).serialize(),
            })
            .done(function(data) {
                if(data==='ok')
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
                    $.alert(data.errors,{
                        autoClose: true,  closeTime: 3000, type: 'danger',
                        position: ['top-right', [500, 30]],
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
            $('#tag-name-add').val('');
            $('#slug-add').val('');
        });
    });
 </script>
   <script src="vendor/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
   <script src="vendor/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
   <script src="js/bootstrap-flash-alert.js"></script>
@endsection
