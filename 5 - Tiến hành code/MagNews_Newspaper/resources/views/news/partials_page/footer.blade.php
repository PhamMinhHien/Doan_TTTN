<!-- Footer -->
    <!-- Footer -->
    <footer>
        <div class="bg2 p-t-40 p-b-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <a href=" ">
                                <img class="max-s-full" src="images/icons/logo-02.png" alt="LOGO">
                            </a>
                        </div>

                        <div>
                            <p class="f1-s-1 cl11 p-b-16">
                                MAGNEWS - Trang tin tức công nghệ , xoay quanh những chủ đề về công nghệ , lập trình , sự kiện , thủ thuật..giúp nâng cao hiểu biết và cập nhật thông tin công nghệ cho người dùng một cách nhanh chóng và tiện lợi nhất.
                            </p>

                            <p class="f1-s-1 cl11 p-b-16">
                                Bất kỳ câu hỏi nào ? Hãy liên hệ trực tiếp với chúng tôi :  (+1) 96 716 6879
                            </p>

                            <div class="p-t-15">
                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-facebook-f"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-twitter"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-pinterest-p"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-vimeo-v"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-youtube"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <h5 class="f1-m-7 cl0">
                                Xem nhiều nhất 
                            </h5>
                        </div>

                        <ul>
                            @foreach($post_footer as $post)
                            <li class="flex-wr-sb-s p-b-20">
                                @if($post->feture)
                                    <?php $image = $post->feture; ?>
                                @else 
                                    <?php $image = 'http://placehold.it/60x60'; ?>
                                @endif
                                <a href="post/{{ $post->slug_post }}.html" class="size-w-4 wrap-pic-w hov1 trans-03">
                                    <img alt="" src="{{$image}}">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="post/{{ $post->slug_post }}.html" class="f1-s-5 cl11 hov-cl10 trans-03">  
                                            {{ $post->title_post}}   
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl6">
                                        {{ $post->created_at}}  
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-sm-6 col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <h5 class="f1-m-7 cl0">
                                Danh mục
                            </h5>
                        </div>

                        <ul class="m-t--12">
                            @foreach($dataMenu as $item)
                                <li class="how-bor1 p-rl-5 p-tb-10">
                                    <a href="category/{{$item->slug_category}}" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                        {{ $item->name_category }} 
                                        @if(count($item->childs) > 0)
                                            ({{ count($item->childs) }})
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>

    <!-- Modal Video - bật ô video khi xem video -->
    <div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" data-dismiss="modal">
            <div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

            <div class="wrap-video-mo-01">
                <div class="video-mo-01">
                    <iframe src="https://www.youtube.com/embed/wJnBTPUQS5A?rel=0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</body>
</html>