@extends('news.layouts.layout')

@section('content')
<!-- Posts -->
@if(isset($tag))
@section('title')
| Tag {{ $tag->name}}
@endsection

	<!-- Breadcrumb - đường dẫn  -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href=" " class="breadcrumb-item f1-s-3 cl9">
					Trang chủ 
				</a>
				<span class="breadcrumb-item f1-s-3 cl9">
					Thẻ tag
				</span>
				<span class="breadcrumb-item f1-s-3 cl9">
					{{$tag->name_tag}}
				</span>
			</div>

			<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
				<form action="search" method="get" accept-charset="utf-8" class="s-full">
	           		<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
	                <button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03" type="submit">
	                    <i class="zmdi zmdi-search"></i>
	                </button>
	           </form>
			</div>
		</div>
	</div>

	<!-- Tiêu đề danh mục  -->
	<div class="container p-t-4 p-b-20">
		<h2 class="f1-l-1 cl2 ">
			Bài viết theo thẻ : {{$tag->name_tag}}
		</h2>
		<hr>
	</div>

	<!-- Bài đăng -->
	<section class="feature-post">
		<div class="container">
			<!-- Category post -->
			<div class="row">
				@foreach($tag->posts as $post)
				<div class="col-md-4 p-r-25 ">
					<!-- Item -->
					<div class="p-b-53">
						@if($post->feture) 
							<?php $image = $post->feture; ?>
						@else 
							<?php $image = 'http://placehold.it/300x220'; ?>
						@endif
						<a href="post/{{$post->slug_post}}.html" class="wrap-pic-w hov1 trans-03">
							<img src="{{$image}}" alt="IMG">
						</a>
						
						<div class="flex-col-s-c p-t-16">
							<h5 class="p-b-5 txt-center">
								<a href="post/{{$post->slug_post}}.html" class="f1-m-3 cl2 hov-cl10 trans-03">
									{{$post->title_post}}
								</a>
							</h5>
							<div class="cl8 txt-center p-b-17">
								<a href="category/{{$post->category->slug_category}}" class="f1-s-4 cl8 hov-cl10 trans-03">
									{{$post->category->name_category}}
								</a>

								<span class="f1-s-3 m-rl-3">
									-
								</span>

								<span class="f1-s-3">
									{{date('G:i d-m-Y', strtotime($post->created_at)) }}
								</span>
							</div>

							<p class="f1-s-11 cl6 txt-center p-b-16">
								{{$post->description_post}}
							</p>

							<a href="detail.html" class="f1-s-1 cl9 hov-cl10 trans-03">
								Đọc thêm
								<i class="m-l-2 fa fa-long-arrow-alt-right"></i>
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	</section>
@else
<!-- Breadcrumb - đường dẫn  -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href=" " class="breadcrumb-item f1-s-3 cl9">
					Trang chủ 
				</a>
				<span class="breadcrumb-item f1-s-3 cl9">
					Thẻ tag
				</span>
				<span class="breadcrumb-item f1-s-3 cl9">
					{{$key}}
				</span>
			</div>

			<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
				<form action="search" method="get" accept-charset="utf-8" class="s-full">
	           		<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
	                <button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03" type="submit">
	                    <i class="zmdi zmdi-search"></i>
	                </button>
	           </form>
			</div>
		</div>
	</div>

	<!-- Tiêu đề danh mục  -->
	<div class="container p-t-4 p-b-20">
		<h2 class="f1-l-1 cl2 ">
			Bài viết theo thẻ : {{$key}}
		</h2>
		<hr>
	</div>

	<!-- Bài đăng -->
	<section class="feature-post">
		<div class="container">
			<!-- Category post -->
			<div class="row p-l-20 m-b-20">
				<h3>Không có bài viết nào được tìm thấy.</h3>
			</div>
		</div>
	</section>
@section('title')
| Không tìm thấy
@endsection
@endif


@endsection