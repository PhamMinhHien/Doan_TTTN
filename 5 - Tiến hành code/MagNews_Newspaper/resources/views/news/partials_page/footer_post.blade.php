<!-- POST - BÀI ĐĂNG CUỐI TRANG  -->
<section class="bg0 p-t-20 p-b-35">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8 p-b-20">
                <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                    <h3 class="f1-m-2 cl3 tab01-title">
                        Bài đăng mới nhất
                    </h3>
                </div>

                <div class="row p-t-35">
                    @foreach($footer_post_new as $post)
                    <div class="col-md-4 p-r-25 p-r-15-sr991">
                        <!-- Item latest -->
                        <div class="m-b-45">
                            @if($post->feture) 
                                 <a href="post/{{ $post->slug_post }}.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="{{$post->feture}}" alt="IMG">
                                </a>
                            @else 
                                 <a href="#" class="wrap-pic-w hov1 trans-03">
                                    <img src="http://placehold.it/60x60" alt="IMG">
                                </a>
                            @endif
                           

                            <div class="p-t-16">
                                <h5 class="p-b-5">
                                    <a href="post/{{ $post->slug_post }}.html" class="f1-m-1 cl2 hov-cl10 trans-03">
                                       {{ $post->title_post }}
                                    </a>
                                </h5>

                                <span class="cl8">
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                        by {{ $post->users->name }}
                                    </a>

                                    <span class="f1-s-3 m-rl-3">
                                        -
                                    </span>

                                    <span class="f1-s-3">
                                        {{ $post->created_at }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-12 col-lg-4">
                <div class="p-l-10 p-rl-0-sr991 p-b-20">
                    <!-- Subscribe -->
                    <div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-55">
                        <h5 class="f1-m-5 cl0 p-b-10">
                            Subscribe
                        </h5>

                        <p class="f1-s-1 cl0 p-b-25">
                            Get all latest content delivered to your email a few times a month.
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

                    <!-- PHẦN TAG CỦA TRANG  -->
                    @include('news.partials_page.tag')
                </div>
            </div>
        </div>
    </div>
</section>