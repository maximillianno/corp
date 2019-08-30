{{--<div id="sidebar-blog-sidebar" class="sidebar group">--}}

    <div class="widget-first widget recent-posts">
        <h3>{{ Lang::get('ru.latest_projects') }}</h3>
        <div class="recent-post group">
        @foreach($portfolios as $portfolio)
            <div class="hentry-post group">
                <div class="thumb-img"><img src="{{asset(env('THEME'))}}/images/projects/{{$portfolio->img->mini}}" style="width: 55px" alt="001" title="001" /></div>
                <div class="text">
                    <a href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}" title="Section shortcodes &amp; sticky posts!" class="title">{{ $portfolio->title }}</a>
                    {!! \Str::limit($portfolio->text, 130) !!}
                    <a class="read-more" href="article.html">&rarr; {{ Lang::get('ru.read_more') }}</a>
                </div>
            </div>


        @endforeach
{{--            <div class="hentry-post group">--}}
{{--                <div class="thumb-img"><img src="{{asset(env('THEME'))}}/images/articles/003-55x55.jpg" alt="003" title="003" /></div>--}}
{{--                <div class="text">--}}
{{--                    <a href="article.html" title="Nice &amp; Clean. The best for your blog!" class="title">Nice &amp; Clean. The best for your blog!</a>--}}
{{--                    <p>Fusce nec accumsan eros. Aenean ac orci a magna vestibulum </p>--}}
{{--                    <a class="read-more" href="article.html">&rarr; Read More</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="hentry-post group">--}}
{{--                <div class="thumb-img"><img src="{{asset(env('THEME'))}}/images/articles/0037-55x55.jpg" alt="0037" title="0037" /></div>--}}
{{--                <div class="text">--}}
{{--                    <a href="article.html" title="Another theme by YIThemes!" class="title">Another theme by YIThemes!</a>--}}
{{--                    <p>Quisque pharetra, risus sit amet vestibulum consequat, elit arcu ultrices </p>--}}
{{--                    <a class="read-more" href="article.html">&rarr; Read More</a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>



    <div class="widget-last widget recent-comments">
        <h3>{{ Lang::get('ru.recent_comments') }}</h3>
        <div class="recent-post recent-comments group">

@if($comments)
@foreach($comments as $comment)
            <div class="the-post group">
                <div class="avatar">
                    @set($hash, ($comment->email)?(md5($comment->email)):(md5($comment->user->email)))
                    <img alt="" src="https://www.gravatar.com/avatar/{{$hash}}?d=mm&s=55" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">{{isset($comment->user)?($comment->user->name):($comment->name)}}</a></strong> in</span>
                <a class="title" href="{{ route('articles.show', ['alias' => $comment->article->alias]) }}">{{ $comment->article->title }}</a>
                <p class="comment">
                    {{ $comment->text }}<a class="goto" href="{{ route('articles.show', ['alias' => $comment->article->alias]) }}">&#187;</a>
                </p>
            </div>
@endforeach
@endif



        </div>
    </div>

{{--</div>--}}
