<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
        @foreach($dataMenu as $item)
            @if(count($item->childs) > 0)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="category/{{$item->slug_category}}" data-toggle="dropdown" >
                    {{ $item->name_category }}
                </a>
                
                <ul class="dropdown-menu">
                    @for ($i = 0 ; $i < count($item->childs) ; $i++)
                        @if($item->id === $item->childs[$i]['parent_id'])
                            @if(count($item->childs[$i]->childsubs) > 0)
                                <li class="dropdown-submenu">
                                    <a href="category/{{$item->childs[$i]['slug_category']}}" class="dropdown-toggle  dropdown-item" data-toggle="dropdown"> {!!$item->childs[$i]['name_category']!!}</a>
                                    <ul class="dropdown-menu">
                                        @for ($j=0; $j < count($item->childs[$i]->childsubs); $j++)
                                            @if($item->childs[$i]['id'] === $item->childs[$i]->childsubs[$j]['parent_id'])
                                                <li class="nav-item">
                                                    <a class="dropdown-item" href="category/{{$item->childs[$i]->childsubs[$j]['slug_category']}}">
                                                        {!!$item->childs[$i]->childsubs[$j]['name_category']!!}
                                                    </a>
                                                </li>
                                            @endif
                                        @endfor
                                    </ul>
                                </li>
                            @else
                                 <li >
                                    <li><a class="dropdown-item" href="category/{{$item->childs[$i]['slug_category']}}"> {!!$item->childs[$i]['name_category']!!} </a></li>
                                </li>
                            @endif
                        @endif
                    @endfor 
                </ul>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link " href="category/{{$item->slug_category}}" tabindex="-1" aria-disabled="true"> 
                        {{ $item->name_category }} 
                    </a>
                </li>
            @endif
         @endforeach
</ul>
</div>