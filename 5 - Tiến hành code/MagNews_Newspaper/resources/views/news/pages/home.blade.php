@extends('news.layouts.layout')

@section('content')
<!-- Feature Post -->

    <section class="feature-post p-t-20">
        <div class="container">
            <div class="row">
                <!-- Slider content post-->
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    @include('news.partials_page.slide_post')
                </div>
                    
                <!-- Tab content post -->
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-post">
                         @include('news.partials_page.tab_post')
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Post -->
    <section class="bg0 p-t-25">
        <div class="container">
            <div class="main-post">
                <!-- Bài đăng mới nhất    -->
                <div class="left-post ">
                    <ul class="list-post">
                        <!-- Danh sách bài post mới nhất  -->
                        @foreach($posts as $post)
                        <li class="shownews">
                            <h4 class="shownews-post-title">
                                <a href="post/{{$post->slug_post}}.html" title="">
                                    {{$post->title_post}}
                                </a>
                            </h4>
                            <div class="shownews-post-content">
                                @if($post->feture)
                                <?php $image = $post->feture;?>
                                @else
                                <?php $image = 'http://placehold.it/300x220'; ?>
                                @endif
                                <div class="shownews-images">
                                    <a href="" title="">
                                        <img src="{{ $image }}" alt="">
                                    </a>
                                </div>
                                <div class="shownews-text">
                                    <div class="shownews-post-meta">
                                        <a href="category/{{$post->slug_category}}" title="" class="shownews-post-category">
                                            {{ $post->name_category }}</a>
                                        <span class="shownews-post-time">
                                             {{date('H:i d-m-Y', strtotime($post->created_at)) }}
                                        </span>
                                    </div>
                                        <span class="shownews-post-description">
                                            {{$post->description_post}}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                    </ul>


                    <!--  Điều chỉnh thành phần phân trang  -->

                    <a href="#" class="flex-c-c size-a-13 bo-all-1 bocl11 f1-m-6 cl6 hov-btn1 trans-03">
                        Load More
                    </a>
                </div>

                <!-- Bài đăng theo danh mục  -->
                <div class="right-post p-b-20">
                    <!-- Danh mục -->
                    @foreach($dataMenu as $item)
                    <div class="category-tab">
                        <div class="category-tab-head ">
                            <!-- Tên danh mục lớn nhất  -->
                            <h3 class="category-tab-title">
                                <a href="category/{{ $item->slug_category }}">
                                    {{ $item->name_category }}
                                </a>
                            </h3>
                            <!-- Những danh mục con - theo tabs  -->

                            <!-- Nếu danh mục có danh mục con thì  -->
                            @if(count($item->childs) > 0)
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-{{ $item['slug_category'] }}" role="tab">All</a>
                                </li>
                                @for ($i = 0 ; $i < count($item->childs) ; $i++)
                                    @if($item->id === $item->childs[$i]['parent_id'])
                                    <!-- Bài đăng phải > 4 mới cho xuất hiện tên danh mục  -->
                                    @if($item->childs[$i]->posts->count() >= 4 )
                                    <!-- Chỉ lấy 3 danh mục con  -->
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"
                                            href="#tab-{{ $item->childs[$i]['slug_category'] }}" role="tab">
                                            {{ $item->childs[$i]['name_category'] }}
                                        </a>
                                    </li>

                                    <li class="nav-item-more dropdown dis-none">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>

                                        <ul class="dropdown-menu">

                                        </ul>
                                    </li>
                                    @endif
                                    @endif
                                    @endfor
                            </ul>
                            <!-- Ngược lại chỉ nên thể hiện tab-all -->
                            @else
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-{{ $item['slug_category'] }}" role="tab">All</a>
                                </li>
                            </ul>
                            @endif
                        
                        </div>

                        <!-- Nội dung những bài đăng theo tabs -->

                        <div class="tab-content p-t-30 p-b-30">
                            <!-- 1 - tab-all  -->
                            @if(count($item->childs) > 0)
                                <!-- Nếu danh mục lớn - có danh mục con -->
                                <div class="tab-pane fade show active" id="tab-{{ $item['slug_category'] }}" role="tabpanel">
                                    <div class="category-content-block">
                                        
                                        <?php 
                                            // Tìm ra id của thằng con nào là con của nó 
                                            $category_childs = $item->where('parent_id',$item->id);
                                            foreach($category_childs as $items)
                                            {
                                                $posts = $items->posts->where('id',$items->id)->where('status',1)->sortByDesc('created_at')->take(1);
                                            }
                                            $post_1 = $posts->shift();
                                        ?>
                                        @if($post_1)
                                        <div class="category-content-first ">
                                            <!-- Item post -->
                                            @if($post_1->feture)
                                            <?php $image = $post_1->feture;?>
                                            @else
                                            <?php $image = 'http://placehold.it/300x220'; ?>
                                            @endif
                                            <div class="item-post-left m-b-30">
                                                <a href="post/{{$post_1->slug_post}}.html" class="item-first-title wrap-pic-w hov1 trans-03">
                                                    <img src="{{ $image }}" alt="IMG">
                                                </a>
                                                <div class="size-left-post">
                                                    <h5 class="p-b-5">
                                                        <a href="post/{{$post_1->slug_post}}.html" class="title-post-left trans-03">
                                                            {{$post_1['title_post']}}
                                                        </a>
                                                    </h5>

                                                    <span class="cate-type">
                                                        <a href="category/{{$post->category->slug_category}}" class="time-bold cate-type hov-cl10 trans-03">
                                                            {{$post_1->category->name_category}}
                                                        </a>

                                                        <span class="time-bold m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="time-regular">
                                                            {{date('G:i d-m-Y', strtotime($post_1['created_at'])) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="category-content-below ">
                                            <!-- Item post -->
                                            @foreach( $posts->take(3) as $post)
                                            <div class="flex-wr-sb-s m-b-10 m-t-20">
                                                @if($post->feture)
                                                <?php $image = $post->feture; ?>
                                                @else
                                                <?php $image = 'http://placehold.it/50x50'; ?>
                                                @endif
                                                <a href="post/{{$post['slug_post'] }}.html"
                                                    class="size-right-img wrap-pic-w hov1 trans-03">
                                                    <img src="{{$image}}" alt="IMG">
                                                </a>

                                                <div class="size-right-post">
                                                    <h5 class="p-b-5">
                                                        <a href="post/{{$post['slug_post'] }}.html"
                                                            class="title-post-right trans-03">
                                                            {{$post['title_post'] }}
                                                        </a>
                                                    </h5>

                                                    <span class="cate-type">
                                                        <a href="category/{{$post->category->slug_category}}" class="time-bold cate-type hov-cl10 trans-03">
                                                            {{$post->category->name_category }}
                                                        </a>

                                                        <span class="time-bold m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="time-regular">
                                                            {{date('G:i d-m-Y', strtotime($post['created_at'])) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                            <!-- Nếu danh mục lớn - ko có danh mục con - chỉ có all tab content-->
                            <div class="tab-pane fade show active" id="tab-{{ $item['slug_category'] }}" role="tabpanel">
                                <div class="category-content-block">
                                    <?php 
                                        $posts = $item->posts->where('status',1)->sortByDesc('created_at')->take(4);
                                        $post_1 = $posts->shift();
                                        ?>
                                    @if($post_1)
                                    <div class="category-content-first ">
                                        <!-- Item post -->
                                        @if($post_1->feture)
                                        <?php $image = $post_1->feture;?>
                                        @else
                                        <?php $image = 'http://placehold.it/300x220'; ?>
                                        @endif
                                        <div class="item-post-left m-b-30">
                                            <a href="post/{{$post_1->slug_post}}.html" class="item-first-title wrap-pic-w hov1 trans-03">
                                                <img src="{{ $image }}" alt="IMG">
                                            </a>
                                            <div class="size-left-post">
                                                <h5 class="p-b-5">
                                                    <a href="post/{{$post_1->slug_post}}.html" class="title-post-left trans-03">
                                                        {{$post_1['title_post']}}
                                                    </a>
                                                </h5>

                                                <span class="cate-type">
                                                    <a href="category/{{$post_1->category->slug_category}}" class="time-bold cate-type hov-cl10 trans-03">
                                                        {{$post_1->category->name_category}}
                                                    </a>

                                                    <span class="time-bold m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="time-regular">
                                                        {{date('G:i d-m-Y', strtotime($post['created_at'])) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="category-content-below ">
                                        <!-- Item post -->
                                        @foreach( $posts->all() as $post)
                                        <div class="flex-wr-sb-s m-b-10 m-t-20">
                                            @if($post->feture)
                                            <?php $image = $post->feture; ?>
                                            @else
                                            <?php $image = 'http://placehold.it/50x50'; ?>
                                            @endif
                                            <a href="post/{{$post['slug_post'] }}.html"
                                                class="size-right-img wrap-pic-w hov1 trans-03">
                                                <img src="{{$image}}" alt="IMG">
                                            </a>

                                            <div class="size-right-post">
                                                <h5 class="p-b-5">
                                                    <a href="post/{{$post['slug_post']}}.html"
                                                        class="title-post-right trans-03">
                                                        {{$post['title_post'] }}
                                                    </a>
                                                </h5>

                                                <span class="cate-type">
                                                    <a href="category/{{$post_1->category->slug_category}}" class="time-bold cate-type hov-cl10 trans-03">
                                                        {{$post_1->category->name_category}}
                                                    </a>

                                                    <span class="time-bold m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="time-regular">
                                                        {{date('G:i d-m-Y', strtotime($post['created_at'])) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- 2 - List tabs còn lại  -->
                            @for ($i = 0 ; $i < count($item->childs) ; $i++)
                                @if($item->id === $item->childs[$i]['parent_id'])
                                @if($item->childs[$i]->posts->count() >= 4)
                                <div class="tab-pane fade " id="tab-{{ $item->childs[$i]['slug_category'] }}" role="tabpanel">
                                     <div class="category-content-block">
                                        <?php 
                                            $posts = $item->childs[$i]->posts->where('status',1)->sortByDesc('created_at')->take(4);
                                            $post_1 = $posts->shift();
                                            ?>
                                        @if($post_1)
                                         <div class="category-content-first">
                                            <!-- Item post -->
                                            @if($post_1->feture)
                                            <?php $image = $post_1->feture;?>
                                            @else
                                            <?php $image = 'http://placehold.it/300x220'; ?>
                                            @endif
                                            <div class="item-post-left m-b-30">
                                                <a href="post/{{$post_1->slug_post}}.html" class="item-first-title wrap-pic-w hov1 trans-03">
                                                    <img src="{{ $image }}" alt="IMG">
                                                </a>
                                                <div class="size-left-post">
                                                    <h5 class="p-b-5">
                                                        <a href="post/{{$post['slug_post']}}.html" class="title-post-left trans-03">
                                                            {{$post['title_post']}}
                                                        </a>
                                                    </h5>

                                                    <span class="cate-type">
                                                        <a href="category/{{$post->category->slug_category}}"
                                                            class="time-bold cate-type hov-cl10 trans-03">
                                                            {{$post->category->name_category}}
                                                        </a>

                                                        <span class="time-bold m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="time-regular">
                                                            {{date('G:i d-m-Y', strtotime($post['created_at'])) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                         <div class="category-content-below">
                                            <!-- Item post -->
                                            @foreach( $posts->all() as $post)
                                            <div class="flex-wr-sb-s m-b-10 m-t-20">
                                                @if($post->feture)
                                                <?php $image = $post->feture; ?>
                                                @else
                                                <?php $image = 'http://placehold.it/50x50'; ?>
                                                @endif
                                                <a href="post/{{$post['slug_post'] }}.html" class="size-right-img wrap-pic-w hov1 trans-03">
                                                    <img src="{{$image}}" alt="IMG">
                                                </a>

                                                <div class="size-right-post">
                                                    <h5 class="p-b-5">
                                                        <a href="post/{{$post['slug_post'] }}.html"
                                                            class="title-post-right trans-03">
                                                            {{$post['title_post'] }}
                                                        </a>
                                                    </h5>

                                                    <span class="cate-type">
                                                        <a href="category/{{$post->category->slug_category}}"
                                                            class="time-bold cate-type hov-cl10 trans-03">
                                                            {{$post->category->name_category}}
                                                        </a>

                                                        <span class="time-bold m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="time-regular">
                                                            {{date('G:i d-m-Y', strtotime($post['created_at'])) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Post new -->
    @include('news.partials_page.footer_post')
<!-- ------------ -->
@endsection
