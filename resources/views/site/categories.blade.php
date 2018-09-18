<div class="span8 sidebar">
     <h1 class="title-bg">Categories</h1>
        <ul class="post-category-list">
            @if($categories)
                @foreach($categories as $category)
                    <li><a href="{{ route('category_single', ['id' => $category->id]) }}"><i class="icon-plus-sign"></i>{{ $category->name }}</a></li>
                @endforeach
            @endif
        </ul>
</div>