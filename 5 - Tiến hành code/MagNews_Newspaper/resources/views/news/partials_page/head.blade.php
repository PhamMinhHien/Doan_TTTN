<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- CSRF Token -->
    <meta name="author" content="phamminhhien">
    <!-- Mỗi page sẽ có title riêng hiển thị -->
    <title> MagNews @yield('title') </title>
    <base href="{{ asset('') }}"></base>
    
    <!-- Liên kết Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!-- Link icon của trang web  -->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/> 

    <!-- Styles CSS của page laravel + css chính của trang -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Link CSS frame-work -->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/swiper/swiper.min.css">

</head>