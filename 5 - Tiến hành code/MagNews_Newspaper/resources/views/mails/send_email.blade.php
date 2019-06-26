@extends('news.layouts.layout')

@section('content')
	<!-- Breadcrumb -->
	<div class="container">
		<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href=" " class="breadcrumb-item f1-s-3 cl9">
					Trang chủ  
				</a>

				<span class="breadcrumb-item f1-s-3 cl9">
					Đăng nhập
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

	<!-- login -->
    <div class="login p-t-20 p-b-30">
        <div class="container">
            <h3 class="title-line animated wow zoomIn" data-wow-delay=".5s"> ĐĂNG NHẬP </h3>
            <p class="est animated wow zoomIn" data-wow-delay=".5s"> 
            	Nhập đầy đủ thông tin email và password để đăng nhập. 
            </p>
            
            <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">

            	<!-- Form -->
                <form action="sendmail" method="post" role="form" accept-charset="utf-8">
                	{{ csrf_field()}}
					@if ($errors->has('error'))
						<div class="alert alert-danger">
							{{ $errors->first('error')}}
						</div>
					@endif

					<input type="email" id="email" class="m-t-5" required=" " placeholder="Email Address"  name="email" value="{{ old('email')}}">
					
 					<input type="text" required=" " placeholder="Name"  name="name">

                    <input type="submit" value="Send">
                </form>
            </div>
           
        </div>
    </div>
    <!-- //login -->
@endsection
