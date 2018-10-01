 <div class="span4 sidebar">

            <!--Search-->
            <section>
                <div class="input-append">
                    <form action="#">
                        <input id="appendedInputButton" size="16" type="text" placeholder="Search"><button class="btn" type="button"><i class="icon-search"></i></button>
                    </form>
                </div>
            </section>

            <!--Categories-->
            <h5 class="title-bg">Categories</h5>
            <ul class="post-category-list">
                @if($categories)
                    @foreach($categories as $category)
                        <li><a href="{{ route('category_single', ['id' => $category->id]) }}"><i class="icon-plus-sign"></i>{{ $category->name }}</a></li>
                    @endforeach
                @endif
            </ul>

            <!--Popular Posts-->
            <h5 class="title-bg">Recents Posts</h5>
            <ul class="popular-posts">
                @if($articles)
                    @foreach($articles as $article)
                        <li>
                            <a href="{{ route('single', ['id' => $article->id]) }}"><img src="{{ $folder_name }}/img/articles/{{ $article->image->mini }}" alt="Popular Post"></a>
                            <h6><a href="{{ route('single', ['id' => $article->id]) }}">{{ $article->title }}</a></h6>
                            <em>Posted on {{ $article->created_at ?  $article->created_at->format('Y/m/d') : '2018\06\07' }}</em>
                        </li>
                    @endforeach
                @endif
            </ul>


            <!--Video Widget-->
          
        </div>

    </div>
    
