<header>
    <!-- 1 - Topbar  -->
    <div class="topbar">
        <div class="container">
         <!-- Left top bar -->
            <div class="left-topbar">
                <a href="#" class="transition-all-03 topbar-item">
                    <span>
                        Viet Nam , VN 
                    </span>
                </a>

                <a href="#" class="transition-all-03 topbar-item">
                    <span>
                        {{ date('Y-m-d H:i:s') }}
                    </span>
                </a>
            </div>

        <!-- Right top bar -->
       
            <div class="right-topbar">
                <a href="aboutus.html" class="transition-all-03 topbar-item">
                    Về chúng tôi
                </a>

                <a href="contact.html" class="transition-all-03 topbar-item">
                    Liên hệ 
                </a>

                <a href="{{ url('login-page')}}" class="transition-all-03 topbar-item">
                    Đăng nhập
                </a>
            </div>
        </div>
    </div>

    <!-- 2 - Logo + Search  -->
    <div class="wrap-logo">
        <div class="container">
            <div class="row">
                <!-- Logo desktop -->
                <div class="col-md-3 logo">
                    <a href=" "><img src="images/icons/logo-01.png" alt="LOGO"></a>
                </div>

                <!-- Search -->
                <div class="col-md-9 banner-header">
                    <!-- Nội dung chưa có thêm  bên phải của logo -->
                </div>
            </div>
        </div>
    </div>

    <!-- 3 - Menu  -->
    <div class="header-menu">
        <div id="my-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="logo-stick" href=" ">
                        <img src="images/icons/logo-01.png" alt="LOGO">
                    </a>

                    <!-- Nút chỉnh menu chế độ Lập trình mobile với mobile!  -->
                    <button class="navbar-toggler float-right" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Menu chính  -->
                    @include('news.partials_page.menu')
                </nav>
            </div>
        </div>
    </div>
</header>