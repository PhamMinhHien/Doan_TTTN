@extends('news.layouts.single_layout')

@section('content')
<!-- Tiêu đề - title -->
	@if(isset($post))

	@section('title')
	| {{ $post->title_post }}
	@endsection
		<!-- Nếu bài đăng là bài kiểu text - văn bản  -->
		
		<!-- Breadcrumb -->
	    <div class="container">
	        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
	            <div class="f2-s-1 p-r-30 m-tb-6">
	                <a href=" " class="breadcrumb-item f1-s-3 cl9">
	                    Trang chủ
	                </a>

	                <a href="category/{{$post->category->slug_category}}" class="breadcrumb-item f1-s-3 cl9">
	                    {{ $post->category->name_category}}
	                </a>

	                <span class="breadcrumb-item f1-s-3 cl9">
	                    {{ $post->title_post }}
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

	    <!-- Content -->
	    @if($post->post_type == 'text') 
	    <section class="bg0 p-b-60 p-t-10">
	        <div class="container">
	            <div class="row justify-content-center">
	                <div class="col-md-10 col-lg-8 p-b-30">
	                    <div class="p-r-10 p-r-0-sr991">
	                        <!-- Blog Detail -->
	                        <div class="p-b-10">
	                        	<!-- Hình ảnh bài đăng  -->
	                            <div class="wrap-pic-max-w p-b-30">
	                            	<a href="" class="featured-img">
		                            	@if($post->feture)
											<?php $image = $post->feture; ?>
										@else 
											<?php $image = 'http://placehold.it/620x375'; ?>
										@endif
		                                <img src="{{$image}}" alt="IMG">
		                            </a>
	                            </div>


	                            <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
	                                {{ $post->title_post }}
	                            </h3>

	                            <div class="p-b-40">
	                                <span class="f1-s-3 cl8 m-r-15">
	                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
	                                        by {{ $post->users->name }}
	                                    </a>

	                                    <span class="m-rl-3">-</span>

	                                    <span>
	                                        {{date('H:i d-m-Y', strtotime($post->created_at)) }}
	                                    </span>
	                                </span>

	                                <span class="f1-s-3 cl8 m-r-15">
	                                    {{ $post->view }} Views
	                                </span>

	                                <!-- <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
	                                    0 Comment
	                                </a> -->
	                            </div>
							
								<div class="post-content">
									{!!  $post->content_post !!}
								</div>

	                            <!-- Tag -->
	                            <div class="tags p-t-12 p-b-15">
	                                <span class="f1-s-12 cl5 m-r-8">
	                                    Tag :
	                                    @foreach($post->tags as $tag)
		                                <a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
	                                        {{ $tag->name_tag }}
	                                    </a>
		                               	@endforeach
	                                </span>
									
	                            </div>

	                            <!-- Share -->
	                            <div class="share "> 
	                                <div class="flex-wr-s-s size-w-0">
	                                    <div class="social-media clearfix">
	                                        <ul>
	                                        	<li>
	                                        		<span class="f1-s-12 cl5 p-t-1 m-r-15">
			                                    		Chia sẻ bài viết :
			                                		</span>
			                            		</li>
	                                            <li class="twitter">
	                                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="(route('/post/{{ $post->slug_category}}.html')" data-text="">Tweet</a>
	                                                
	                                                <script>
	                                                !function(d,s,id)
	                                                {
	                                                	var js,fjs=d.getElementsByTagName(s)[0];
	                                                	if(!d.getElementById(id))
	                                                	{
	                                                		js=d.createElement(s);js.id=id;
	                                                		js.src="//platform.twitter.com/widgets.js";
			                                            	fjs.parentNode.insertBefore(js,fjs);
			                                        	}
			                                    	}(document,"script","twitter-wjs");

			                                		</script>
	                                            </li>
	                                            <li class="facebook-like">
	                                               <script>(function(d, s, id) {
													    var js, fjs = d.getElementsByTagName(s)[0];
													    if (d.getElementById(id)) return;
													    js = d.createElement(s); js.id = id;
													    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
													    fjs.parentNode.insertBefore(js, fjs);
													  }(document, 'script', 'facebook-jssdk'));</script>

	                                                <div class="fb-like" data-href="(route('/post/{{ $post->slug_category}}.html')" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" ></div>
	                                            </li>
	                                            <li class="facebook-share">
													<script>(function(d, s, id) {
													    var js, fjs = d.getElementsByTagName(s)[0];
													    if (d.getElementById(id)) return;
													    js = d.createElement(s); js.id = id;
													    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
													    fjs.parentNode.insertBefore(js, fjs);
													  }(document, 'script', 'facebook-jssdk'));
													</script>

													  <!-- Your share button code -->
													<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
	                                            </li>

	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        <!-- Leave a comment -->
	                        <h3>Bình Luận</h3>
	                        <script>
	                        	(function (d, s, id) {
	                                var js, fjs = d.getElementsByTagName(s)[0];
	                                if (d.getElementById(id)) return;
	                                js = d.createElement(s); js.id = id;
	                                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=863868720428280";
	                                fjs.parentNode.insertBefore(js, fjs);
	                            }(document, 'script', 'facebook-jssdk'));
	                        </script>

	                        <div class="fb-comments" data-href="http://localhost:82/Backend/2-Laravel/4_Project_doing/source-code/Magnew_Newspaper/public/post/tai-sao-mot-dev-khong-the-la-mot-tester-gioi.html" data-width="" data-numposts="5"></div>
	                    </div>
	                </div>

	                <!-- Sidebar -->
	                <div class="col-md-10 col-lg-4 p-b-30">
	                	
	                	 <!-- Subscribe -->
	                    <div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-55">
	                        <h5 class="f1-m-5 cl0 p-b-10">
	                            Subscribe ( Theo dõi ) 
	                        </h5>

	                        <p class="f1-s-1 cl0 p-b-25">
	                            Hãy nhập email của bạn bên dưới , để nhận tất cả nội dung mới nhất được gửi đến email của bạn một vài lần một tháng .
	                        </p>

							<form class="size-a-9 pos-relative" method="post" action="{{url('sendmail')}}">
								{{ csrf_field()}}
								
								<input class="s-full f1-m-6 cl6 plh9 p-l-20 p-r-55" type="email" name="email"
									placeholder="Email" required>
								<button type="submit" class="size-a-10 flex-c-c ab-t-r fs-16 cl9 hov-cl10 trans-03">
									<i class="fa fa-arrow-right"></i>
								</button>
							</form>
							 <!-- Thông báo lỗi khi nhập email  -->
							 @if (count($errors) > 0)
								<div class="alert alert-danger m-t-10">
									<ul>
										@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
						
							@if (session('alert'))
								<div class="alert alert-success m-t-10">
									{{ session('alert') }}
								</div>
							@endif
						</div>
						

						@include('news.partials_page.sidebar')
						
						<!-- PHẦN TAG CỦA TRANG  -->
						
	                    @include('news.partials_page.tag')
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif

	    <!-- Bài đăng liên quan  -->
	    @if($post_relative->count() != 0)
	    <section class="bg0 p-t-40 p-b-35">
		    <div class="container">
		       <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                    <h3 class="f1-m-2 cl3 tab01-title">
                        Bài viết liên quan 
                    </h3>
                </div>

                <div class="row p-t-35">
                    @foreach($post_relative as $items)
                    <div class="col-sm-3 p-r-25 p-r-15-sr991">
                        <!-- Item latest -->
                        <div class="m-b-45">
                            @if($items->feture) 
                                 <a href="post/{{$items->slug_post}}.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="{{$items->feture}}" alt="IMG">
                                </a>
                            @else 
                                 <a href="#" class="wrap-pic-w hov1 trans-03">
                                    <img src="http://placehold.it/60x60" alt="IMG">
                                </a>
                            @endif
                           

                            <div class="p-t-16">
                                <h5 class="p-b-5">
                                    <a href="post/{{ $items->slug_post }}.html" class="f1-m-1 cl2 hov-cl10 trans-03">
                                       {{ $items->title_post }}
                                    </a>
                                </h5>

                                <span class="cl8">
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                        by {{ $items->users->name }}
                                    </a>

                                    <span class="f1-s-3 m-rl-3">
                                        -
                                    </span>

                                    <span class="f1-s-3">
                                        {{ $items->created_at }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
		    </div>
		</section>
		@endif
	@else
	<!-- Breadcrumb -->
    <div class="container">
        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <a href=" " class="breadcrumb-item f1-s-3 cl9">
                    Trang chủ
                </a>
                <span class="breadcrumb-item f1-s-3 cl9">
                    {{ $key}}
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
    <section class="bg0 p-b-60 p-t-10">
        <div class="container p-b-40">
			<h3>Bài viết không tồn tại.</h3>
		</div>
	</section>
	@section('title')
	| Không tìm thấy
	@endsection
	@endif
@endsection