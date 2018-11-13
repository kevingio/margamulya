@extends('layouts.master')

@section('page-title')
    {{ $article->title }}
@endsection

@section('content')
<div class="home">
    @if(!empty($article->background_img))
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ $article->background_img }}" data-speed="0.8"></div>
    @else
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('app-asset/img/category.jpg') }}" data-speed="0.8"></div>
    @endif
    <div class="home_content">
        <a href="{{ url('article') }}" class="tag">Articles</a>
        <div class="post_title">{{ $article->title }}</div>
    </div>
</div>
<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9">
                <div class="post_content">
                    <div class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
                        <div class="author_image">
                            <div>
                                @if(empty($article->user->avatar))
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd5_kbfqZdTTsP506OSSvpu9A5nU6JgzV-qfrBq_N_513GdBrZ" alt="">
                                @else
                                <img src="{{ Storage::url($article->user->avatar) }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="post_meta">{{ $article->user->name }}<span>{{ date('l, d F Y', strtotime($article->created_at)) }} at {{ date('H:i', strtotime($article->created_at)) }}</span></div>
                        <div class="post_share ml-sm-auto">
                            <span>share</span>
                            <ul class="post_share_list">
                                @if($isMobile == true)
                                <li class="post_share_item"><a href="line://msg/text/?{{ $article->title }} {{ url()->current() }}" data-action="share/line/share"><i class="fab fa-line" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="whatsapp://send?text={{ $article->title }} {{ url()->current() }}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                                @endif
                                <li class="post_share_item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share d-block d-sm-none">
                        <p>share this article</p>
                        <ul class="post_share_list">
                            @if($isMobile == true)
                            <li class="post_share_item"><a href="line://msg/text/?{{ $article->title }} {{ url()->current() }}" data-action="share/line/share"><i class="fab fa-line" aria-hidden="true"></i></a></li>
                            <li class="post_share_item"><a href="whatsapp://send?text={{ $article->title }} {{ url()->current() }}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            @endif
                            <li class="post_share_item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="post_body text-justify">
                        {!! $article->content !!}
                    </div>
                    <div class="similar_posts">
                        <div class="post_comment">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="disqus_thread"></div>
                                    <script>

                                    var disqus_config = function () {
                                    this.page.url = "{{ url()->current() }}";
                                    this.page.identifier = {{ $article->id }};
                                    };
                                    (function() {
                                    var d = document, s = d.createElement('script');
                                    s.src = 'https://gpip-marga-mulya.disqus.com/embed.js';
                                    s.setAttribute('data-timestamp', +new Date());
                                    (d.head || d.body).appendChild(s);
                                    })();
                                    </script>
                                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="load_more">
                    <!-- <div id="load_more" class="load_more_button text-center trans_200">Load More</div> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar_background"></div>
                    @include('layouts.parts.latest-article')
                    <div class="future_events">
                        @include('layouts.parts.calendar')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script id="dsq-count-scr" src="//gpip-marga-mulya.disqus.com/count.js" async></script> -->
@endsection
