@extends('admin.layouts.layout')
@section('content')
<!-- Page Content -->
	<div id="page-wrapper">
	    <div class="container-fluid">
	        <div class="row" style="margin-bottom: 40px">
	        		<div class="col-lg-12">
	                <h1 class="page-header">Tài khoản 
						<small>Thông tin cá nhân </small>
	                </h1>
	                </div>
	            <div class="col-lg-5">
	            	<div class="panel panel-default">
	                    <div class="panel-heading">
	                        <i class="fa fa-user fa-fw"></i> Thông tin cá nhân
	                    </div>
	                    <div class="panel-body">
	                        <div class="white-box">
	                            <div class="user-bg">
	                                <div class="row">
	                                	<div class="col-md-4">
	                                		<div class="avatar-box">
	                                			@if($profile->avatar)
													<?php $image = $profile->avatar; ?>
												@else 
													<?php $image = 'http://placehold.it/600x600'; ?>
												@endif
	                                			<a href="javascript:void(0)"><img src="{{ $image}}" class="thumb-lg img-circle" alt="img"></a>
	                                		</div>
	                                	</div>
	                                	<div class="col-md-8">
	                                		<div class="info-box">
	                                			<h5 class="text-white"> Tên : {{ $profile->name }}</h5>
			                                    <h5 class="text-white"> Ngày sinh : {{ $profile->birthday }}</h5>
			                                    <h5 class="text-white"> Email : {{ $profile->email }}</h5> 
	                                		</div>
	                                	</div>
	                                </div>
	                            </div>
	                            <hr>
	                            <div class="user-btm-box row">
	                                <div class="col-md-6 col-sm-6 text-center">
	                                    <p class="text-purple">
	                                    	<i class="fa fa-pencil fa-fw fa-text-box"></i><span class="span-fa-text">Bài viết</span> 
	                                    </p>
	                                    <h2>{{ $profile->posts->count('users_id')}}</h2> 
	                                </div>
	                                <div class="col-md-6 col-sm-6 text-center">
	                                    <p class="text-danger"><i class="fa fa-file fa-text-box" aria-hidden="true"></i></i><span class="span-fa-text"> Tổng bài </span> </p>
	                                    <h2>{{ $post_count }}</h2> 
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-7">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <i class="fa fa-cog" aria-hidden="true"></i> Tùy chỉnh thông tin
	                    </div>
	                    <!-- /.panel-heading -->
	                    <div class="panel-body">
	                        <!-- Nav tabs -->
	                        <ul class="nav nav-tabs">
	                            <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Cập nhật thông tin cá nhân</a>
	                            </li>
	                            <li class=""><a href="#posts" data-toggle="tab" aria-expanded="false">Danh sách bài đăng</a>
	                            </li>
	                        </ul>

	                        
	                        <div class="tab-content">
	                        	<!-- Nội dung form profile  -->
	                            <div class="tab-pane fade active in" id="home">
	                            	<br>
	                            	<!-- Thông báo lỗi  -->
	                            	@if(count($errors) > 0)
					                    <div class="alert alert-danger">
					                        @foreach($errors->all() as $err)
					                            {{ $err }}<br>
					                        @endforeach
					                    </div>
					                @endif
					                <!-- Thông báo thành công -->
					                @if(Session::has('flash_success'))
						                <div class="alert alert-success">
						                    {{ session('flash_success') }}
						                </div>
					                @endif
	                                <form action="admin/profile/update" method="post" enctype="multipart/form-data">
					                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
					                    <div class="form-group">
					                        <label>Họ và tên : </label>
					                        <input class="form-control" name="name" value="{{ $profile->name }}" />
					                    </div>
					                    <div class="form-group">
					                        <label>Ngày Sinh</label>
					                        <input class="form-control" name="birthday" type="date" value="{{ $profile->birthday }}" />
					                    </div>
					                    <div class="form-group">
					                        <label>Email</label>
					                        <input class="form-control" name="email" type="text" value ="{{ $profile->email }}" />
					                    </div>
					                     <div class="form-group">
					                        <label>Password</label>
					                        <input class="form-control" name="password" type="password">
					                    </div>
					                     
					                     <div class="form-group">
					                        <label>Hình ảnh giao diện : </label>
					                        <input class="form-control" name="avatar" type="file" />
					                    </div>
					                    <button type="reset" class="btn btn-default m-l-25">Làm mới</button>
					                    <button type="submit" class="btn btn-success ">Cập nhật thông tin </button>
						            </form>
	                            </div>
	
	                            <!-- Nội dung bài viết - danh sách bài viết  -->
	                            <div class="tab-pane fade " id="posts">
	                            	<h3>Danh sách các bài viết của bạn</h3>
	                            	<hr>
	                            	<div class="list-group">
	                               	 	@foreach($posts as $post)
	                                        <a href="post/{{$post->slug_post}}.html"><p><i class="fa fa-arrow-circle-right"></i> {{$post->title_post}} </p></a>
	                                	@endforeach
	                            	</div>
	                            	
	                            	<!-- Pagination -->
									<div class="pagination">
										{{ $posts->links() }}
									</div>
	                            </div>
	                        </div>
	                    </div>
	                    <!-- /.panel-body -->
	                </div>
	                <!-- /.panel -->
	            </div>
	        </div>
	    </div>
	</div>
@endsection