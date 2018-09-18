 <div class="span8 blog">

            <!-- Blog Post 1 -->
            <article>
                <h3 class="title-bg"><a href="#">{{ $article->title }}</a></h3>
                <div class="post-content">
                    <a href="#"><img src="{{ $folder_name }}/img/articles/{{ $article->image->path }}" alt="Post Thumb"></a>

                    <div class="post-body">
                        <p>{!! $article->text !!}</p>
                    </div>

                    <div class="post-summary-footer">
                        <ul class="post-data">
                            <li><i class="icon-calendar"></i> {{ $article->created_at ?  $article->created_at->format('Y/m/d') : '2018\06\07' }}</li>
                            <li><i class="icon-user"></i> <a href="#">{{ $article->user->name }}</a></li>
                            <li><i class="icon-tags"></i>
                            @foreach($article->categories as $category)
                                <a href="#">{{ $category->name }}</a>,
                            @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </article>

            <!-- About the Author -->
            <section class="post-content">
                <div class="post-body about-author">
                    <h4>About {{ $article->user->name }}</h4>
                    Proin tristique tellus in est vulputate luctus fermentum ipsum molestie. Vivamus tincidunt sem eu magna varius elementum. Maecenas felis tellus, fermentum vitae laoreet vitae, volutpat et urna. Nulla faucibus ligula eget ante varius ac euismod odio placerat. Nam sit amet felis non lorem faucibus rhoncus vitae id dui.
                </div>
            </section>

        <!-- Post Comments
        ================================================== --> 
         
</div>