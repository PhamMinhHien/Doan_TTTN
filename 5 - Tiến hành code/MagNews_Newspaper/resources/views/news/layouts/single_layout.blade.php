
<!---------- Bố cục trang đơn : những trang như : post , contact ... ko có nhiều thành phần  ----------->

<!DOCTYPE html>
<html>
	<!-- Phần head -->
	@include('news.partials_page.head')
<body class="animsition">
	<!-- Header --> 
	@include('news.partials_page.header') 

	<!-- Phần nội dung chính của page -->
	@yield('content')
	
	<!-- Footer --> 
	@include('news.partials_page.footer') 

	<!-- Import js -->
	@include('news.partials_page.importjs')

	<!-- Phần js viết thêm cho page -->
	@yield('js')
</body>
</html>