<!------------ Bố cục trang home  ----------->

<!DOCTYPE html>
<html>
	<!-- Phần head -->
	@include('news.partials_page.head')
<body class="animsition">
	<!-- Link facebook dành cho share + like  -->
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3"></script>
	
	<!-- Header --> 
	@include('news.partials_page.header') 

	<!-- Phần nội dung chính của page -->
	@yield('content')
	
	<!-- Footer --> 
	@include('news.partials_page.footer') 


	<!-- Import js chính -->
	@include('news.partials_page.importjs')

	<!-- Phần js viết thêm trên tùy trang -->
	@yield('js')
</body>
</html>