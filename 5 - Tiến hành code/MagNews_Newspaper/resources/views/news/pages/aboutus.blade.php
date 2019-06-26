@extends('news.layouts.single_layout')
@section('content')
<!-- Breadcrumb -->
    <div class="container">
        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <a href=" " class="breadcrumb-item f1-s-3 cl9">
                    Trang chủ  
                </a>

                <span class="breadcrumb-item f1-s-3 cl9">
                    Về chúng tôi
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

    <!-- Page heading -->
    <div class="container p-t-4 p-b-35">
        <h2 class="f1-l-1 cl2">
            Về chúng tôi
        </h2>
    </div>

    <!-- Content -->
    <section class="bg0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                        <p class="f1-s-11 cl6 p-b-25">
                             MAGNEWS - Trang tin tức công nghệ , xoay quanh những chủ đề về công nghệ , lập trình , sự kiện , thủ thuật ... giúp nâng cao hiểu biết và cập nhật thông tin công nghệ cho người dùng một cách nhanh chóng và tiện lợi nhất .
                        </p>
                        <p class="f1-s-11 cl6 p-b-25">
                            Công ty cổ phần MAGNEWS . <br>
                            Trang thông tin điện tử. <br>
                            Giấy phép số: 1531/GP-TTĐT do Sở Thông tin và Truyền thông Hà Nội cấp ngày 09/06/2015.<br>
                            Chịu trách nhiệm nội dung: Phạm Minh Hiển. <br>
                            ĐT: +84-243-5586999; <br>
                            Email: lienhe@tinmoi.vn <br>
                            Địa chỉ trụ sở: P801 Tháp A tòa nhà Hà Thành, Số 102 Thái Thịnh, phường Trung Liệt, quận Đống Đa, thành phố Hà Nội.<br>
                            Địa chỉ giao dịch: Tầng 4, Tháp A, Tòa nhà Sông Đà, Đường Phạm Hùng - Hà Nội.<br>
                            Liên hệ quảng cáo: 0944011368 - Email: thuan.trinh@netlink.vn <br>
                        </p>  
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('news.partials_page.footer_post')

@endsection