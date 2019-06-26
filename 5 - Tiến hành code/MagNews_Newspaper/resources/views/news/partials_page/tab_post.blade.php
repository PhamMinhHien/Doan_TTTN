<!-- Phần tab-content bài đăng - Trang home   -->
<div class="tab-content-main">
    <ul class="nav nav-tabs">
        <li class="nav-item ">
            <a class="nav-link active" data-toggle="tab" href="#noi-bat">Nổi Bật </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#gan-day">Gần Đây </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#top-view">Top View</a>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div id="noi-bat" class="tab-pane in active">
        <ul>
            @foreach($tab_post_hot as $post)
            <li class="shine-o">
                @if($post->feture)
                    <?php $image = $post->feture; ?>
                @else 
                    <?php $image = 'http://placehold.it/60x60'; ?>
                @endif
                <a href="post/{{ $post->slug_post }}.html"><img alt="" src="{{$image}}"></a>
                <h3><a href="post/{{ $post->slug_post }}.html">{{ $post->title_post }}</a></h3>
                <div class="post-date">{{date('G:i d-m-Y', strtotime($post->created_at)) }}</div>
            </li>
            @endforeach
        </ul>
    </div>
    <div id="gan-day" class="tab-pane fade">
        <ul>
            @foreach($tab_post_time as $post)
            <li class="shine-o">
                @if($post->feture) 
                    <?php $image = $post->feture ?>
                @else 
                    <?php $image = 'http://placehold.it/60x60'; ?>
                @endif
                <a href="post/{{ $post->slug_post }}.html"><img alt="" src="{{$image}}"></a>
                <h3><a href="post/{{ $post->slug_post }}.html">{{ $post->title_post }}</a></h3>
                <div class="post-date">{{date('G:i d-m-Y', strtotime($post->created_at)) }}</div>
            </li>
            @endforeach
        </ul>
    </div>
    <div id="top-view" class="tab-pane fade">
        <ul>
            @foreach($tab_post_view as $post)
            <li class="shine-o">
                @if($post->feture) 
                    <?php $image = $post->feture; ?>
                @else 
                    <?php $image = 'http://placehold.it/60x60'; ?>
                @endif
                <a href="post/{{ $post->slug_post }}.html"><img alt="" src="{{$image}}"></a>
                <h3><a href="post/{{ $post->slug_post }}.html">{{ $post->title_post }}</a></h3>
                <div class="post-date">
                    {{date('G:i d-m-Y', strtotime($post->created_at)) }} || {{$post->view}} Views
                </div>
                

            </li>
            @endforeach
        </ul>
    </div>
</div>