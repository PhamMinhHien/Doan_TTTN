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
			<!-- Form 1  -->
			<form  id="login-magnew" action="{{ route('login-post')}}" method="post" role="form" accept-charset="utf-8">
				{{ csrf_field()}}
				<!-- Recaptcha Google  -->
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				

				<input type="email" id="email" class="form-control" required=" " placeholder="Email Address"  name="email" value="{{ old('email')}}">
				<p id="result-email"> </p>

				<input id="password" type="password" placeholder="Password" required=" " name="password" disabled>
				<p id="result-pass"> </p>
				
				<div class="forgot">
                    <a href="#">Quên mật khẩu ?</a>
                </div>

				<div class="register-check-box animated wow slideInUp" data-wow-delay=".5s">
					<div class="check">
						<label class="checkbox"><input type="checkbox" name="remember_token"><i> </i> Remember Me </label>
					</div>
				</div>



				<!-- Recaptcha Google  -->
				<div class="form-group row p-t-20 " data-wow-delay=".5s">
					<div class="col-sm-3 wrap-pic-w">
						<img src="{{url('/images/robot.png')}}" alt="Image">
					</div>
					<div class="col-md-9 ">
						<div class="g-recaptcha" data-sitekey="6LfptKgUAAAAAFvtv4CXofhjc45yqnE5ffJ_USDG"></div>
					</div>
				</div>
				<!-- Recaptcha Google  -->

				<!-- Button Submit  -->
				<input id="btn-submit" type="submit" value="Đăng Nhập" disabled>
			</form>
		</div>
	</div>
</div>

   
<!-- //login -->
@endsection
