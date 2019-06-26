 <div class="p-l-10 p-rl-0-sr991 p-t-20">
 	<!-- Popular Posts -->
 	<div class="p-b-30">
 		<div class="how2 how2-cl4 flex-s-c">
 			<h3 class="f1-m-2 cl3 tab01-title">
 				Bài đăng nổi bật 
 			</h3>
 		</div>

 		<ul class="p-t-35">
			@foreach($post as $item)
 			<li class="flex-wr-sb-s p-b-30">
 				<a href="post/{{$item->slug_post}}.html" class="size-w-10 wrap-pic-w hov1 trans-03">
 					@if($item->feture)
						<?php $image = $item->feture; ?>
					@else 
						<?php $image = 'http://placehold.it/620x375'; ?>
					@endif
	                <img src="{{$image}}" alt="IMG">
 				</a>

 				<div class="size-w-11">
 					<h6 class="p-b-4">
 						<a href="post/{{$item->slug_post}}.html" class="f1-s-5 cl3 hov-cl10 trans-03">
 							{{$item->title_post}}
 						</a>
 					</h6>

 					<span class="cl8 txt-center p-b-24">
 						<a href="category/{{$item->category->slug_category}}" class="f1-s-6 cl8 hov-cl10 trans-03">
 							{{$item->category->name_category}}
 						</a>

 						<span class="f1-s-3 m-rl-3">
 							-
 						</span>

 						<span class="f1-s-3">
 							{{$item->created_at}}
 						</span>
 					</span>
 				</div>
 			</li>
 			@endforeach
 		</ul>
 	</div>
 </div>