<div class="span8 blog">
    @if(count($articles) > 0)
         @foreach($articles as $article)
             @foreach($article->categories as $cat)
                 @if($cat->id == $id)
                    <article class="clearfix">
                        <a href="{{ route('single', ['id' => $article->id]) }}"><img src="{{ $folder_name }}/img/articles/{{ $article->image->max }}" alt="Post Thumb" class="align-left"></a>
                                    <h4 class="title-bg"><a href="{{ route('single', ['id' => $article->id]) }}">{{ $article->title }}</a></h4>
                            <p>{!! $article->description !!}</p>
                            <a class="btn btn-mini btn-inverse" href = "{{ route('single', ['id' => $article->id]) }}">Read more</a>
                            <div class="post-summary-footer">
                                <ul class="post-data-3">
                                    <li><i class="icon-calendar"></i>{{ $article->created_at ?  $article->created_at->format('Y/m/d') : '2018\06\07' }}</li>
                                    <li><i class="icon-user"></i> <a href="#">{{ $article->user->name }}</a></li>
                                    <li><i class="icon-tags"></i>
                                    @foreach($article->categories as $category)
                                        <a href = "{{ route('category_single', ['id' => $category->id]) }}">{{ $category->name.','}} </a>
                                    @endforeach

                                    </li>
                                </ul>
                            </div>
                    </article>
                @endif
            @endforeach
        @endforeach
    @endif

            <!-- Blog Post 1 -->

            <!-- Pagination -->

</div>