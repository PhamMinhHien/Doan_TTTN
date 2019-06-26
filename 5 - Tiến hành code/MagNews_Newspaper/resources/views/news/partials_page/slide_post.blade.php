<!-- Slide - lấy 8 -10 bài đăng mới nhất  -->
<div class="main-slider">
    <div class="swiper-container">
        <div class="swiper-wrapper">
             @foreach($slide_post as $post)
            <div class="swiper-slide">
                <a href="post/{{ $post->slug_post }}.html" title="">
                    <img src="{{ $post->feture }}" alt="{{ $post->feture }}">
                </a>
                <div class="flex-caption">
                    <div class="desc">
                        <a href="post/{{ $post->slug_post }}.html" class="transition-all-03">{{ $post->title_post}}</a>
                        <p>{{ $post->description_post }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>