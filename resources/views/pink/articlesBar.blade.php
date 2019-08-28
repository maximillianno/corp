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
        <h3>Recent Comments</h3>
        <div class="recent-post recent-comments group">

            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="{{asset(env('THEME'))}}/images/avatar/unknow55.png" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">eduard</a></strong> in</span>
                <a class="title" href="article.html">Nice &amp; Clean. The best for your blog!</a>
                <p class="comment">
                    hi <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>

            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="{{asset(env('THEME')).'/images/avatar/nicola55.jpeg'}}" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:nicola@yopmail.com">nicola</a></strong> in</span>
                <a class="title" href="article.html">This is the title of the first article. Enjoy it.</a>
                <p class="comment">
                    While i’m the author of the post. My comment template is different,... <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>

            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="{{asset(env('THEME'))}}/images/avatar/unknow55.png" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">Anonymous</a></strong> in</span>
                <a class="title" href="article.html">This is the title of the first article. Enjoy it.</a>
                <p class="comment">
                    Hi all, i’m a guest and this is the guest’s awesome comments... <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>
        </div>
    </div>

{{--</div>--}}
