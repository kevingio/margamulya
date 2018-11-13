@if(count($latest_articles) > 0)
<div class="sidebar_section">
    <div class="sidebar_title_container">
        <div class="sidebar_title">Latest Articles</div>
        <div class="sidebar_slider_nav">
            <div class="custom_nav_container sidebar_slider_nav_container">
                <div class="custom_prev custom_prev_top">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                        <polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
                    </svg>
                </div>
                <ul class="custom_dots custom_dots_top">
                    @foreach($latest_articles as $article)
                    <li class="custom_dot custom_dot_top @if($loop->first) active @endif"><span></span></li>
                    @endforeach
                </ul>
                <div class="custom_next custom_next_top">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                        <polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_section_content">

        <div class="sidebar_slider_container">
            <div class="owl-carousel owl-theme sidebar_slider_top">

                @foreach($latest_articles->chunk(5) as $chunk)
                <div class="owl-item">
                    @foreach($chunk as $article)
                    <div class="side_post">
                        <a href="{{ route('show-article', [$article->id]) }}">
                            <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                <div class="side_post_image">
                                    <div>
                                        @if(empty($article->background_img))
                                        <img src="{{ asset('app-asset/img/top_1.jpg') }}" class="rounded" alt="">
                                        @else
                                        <img src="{{ asset($article->background_img) }}" class="rounded" alt="">
                                        @endif
                                    </div></div>
                                <div class="side_post_content">
                                    <div class="side_post_title mt-2">{{ $article->title }}</div>
                                    <small class="post_meta">{{ $article->user->name }}<span>{{ $article->created_at->diffForHumans() }}</span></small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
