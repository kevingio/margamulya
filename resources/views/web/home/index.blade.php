@extends('layouts.home')

@section('page-title')
    GPIB Margamulya
@endsection

@section('content')
<div class="home">
    <div class="home_slider_container">
        <div class="owl-carousel owl-theme home_slider">

            @foreach($events as $event)
            <div class="owl-item">
                @if(empty($event->thumbnail))
                <div class="home_slider_background" style="background-image:url(app-asset/img/background-login.jpeg)"></div>
                @else
                <div class="home_slider_background" style="background-image:url({{ $event->thumbnail }})"></div>
                @endif
                <div class="home_slider_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_slider_content">
                                    <div class="home_slider_item_category trans_200"><a href="{{ route('event') }}" class="trans_200">Events</a></div>
                                    <div class="home_slider_item_title">
                                        <a href="{{ route('show-event', [$event->id]) }}">{{ $event->title }}</a>
                                    </div>
                                    <div class="home_slider_item_link">
                                        <a href="{{ route('show-event', [$event->id]) }}" class="trans_200">Continue Reading
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 width="19px" height="13px" viewBox="0 0 19 13" enable-background="new 0 0 19 13" xml:space="preserve">
                                                <polygon fill="#FFFFFF" points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 "/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Content -->
                @if (count($events) > 0)
                <div class="similar_posts_container">
                    <div class="home_slider_next_container">
                        @if($loop->remaining == 0)
                            @if(empty($events[0]->thumbnail))
                            <div class="home_slider_next" style="background-image:url(app-asset/img/category.jpg)">
                            @else
                            <div class="home_slider_next" style="background-image:url({{ $events[0]->thumbnail }})">
                            @endif
                                <div class="home_slider_next_background trans_400"></div>
                                <div class="home_slider_next_content trans_400">
                                    <div class="home_slider_next_title">next</div>
                                    <h3 class="text-light font-weight-bold">{{ $events[0]->title }}</h3>
                                    <p class="text-light m-0">{{ $events[0]->date }}</p>
                                    <p class="text-light">{{ $events[0]->start_hour. ' - ' . $events[0]->end_hour }}</p>
                                </div>
                            </div>
                            @else

                            @if(empty($events[$loop->index + 1]->thumbnail))
                            <div class="home_slider_next" style="background-image:url(app-asset/img/category.jpg)">
                            @else
                            <div class="home_slider_next" style="background-image:url({{ $events[$loop->index + 1]->thumbnail }})">
                            @endif
                                <div class="home_slider_next_background trans_400"></div>
                                <div class="home_slider_next_content trans_400">
                                    <div class="home_slider_next_title">next</div>
                                    <div class="home_slider_next_link">
                                        <h3 class="text-light font-weight-bold">{{ $events[$loop->index + 1]->title }}</h3>
                                        <p class="text-light m-0">{{ $events[$loop->index + 1]->date }}</p>
                                        <p class="text-light">{{ $events[$loop->index + 1]->start_hour. ' - ' . $events[$loop->index + 1]->end_hour }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

            </div>
            @endforeach

        </div>
        <div class="custom_nav_container home_slider_nav_container">
            <div class="custom_prev custom_prev_home_slider">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                    <polyline fill="#FFFFFF" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
                </svg>
            </div>
            <ul class="custom_dots custom_dots_home_slider">
                @foreach($latest_articles->take(3) as $article)
                <li class="custom_dot custom_dot_home_slider @if($loop->first) active @endif"><span></span></li>
                @endforeach
            </ul>
            <div class="custom_next custom_next_home_slider">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                    <polyline fill="#FFFFFF" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
                </svg>
            </div>
        </div>

    </div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <div class="col-lg-9">
                <div class="main_content">

                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Latest Articles</div>
                        </div>
                        <div class="section_content clearfix">
                            <div id="grid" data-columns>
                                @foreach($latest_articles->take(6) as $article)
                                @if(!empty($article->background_img))
                                <div class="card card_default card_small_with_image grid-item">
                                    <img class="card-img-top" src="{{ $article->background_img }}" alt="">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="{{ route('show-article', [$article->id]) }}">{{ $article->title }}</a></div>
                                        <small class="post_meta"><a href="#">{{ $article->user->name }}</a><span>{{ $article->created_at->diffForHumans() }}</span></small>
                                    </div>
                                </div>
                                @else
                                <div class="card card_default card_small_no_image grid-item">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="{{ route('show-article', [$article->id]) }}">{{ $article->title }}</a></div>
                                        <small class="post_meta"><a href="#">{{ $article->user->name }}</a><span>{{ $article->created_at->diffForHumans() }}</span></small>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="load_more_button text-center trans_200 mt-5" onclick="window.location.href='/article'">Load More</div>

                    @if(count($files) > 0)
                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Recent Videos</div>
                        </div>
                        <div class="section_content">
                            <div class="row">
                                <div class="col">
                                    <div class="videos">
                                        <div class="player_container">
                                            <div id="P1" class="player"
                                                 data-property="{videoURL:'{{ $files[0]->filename }}',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1}">
                                            </div>
                                        </div>
                                        <div class="playlist">
                                            <div class="playlist_background"></div>

                                            @foreach($files as $file)
                                            <div class="video_container video_command @if($loop->first) active @endif" onclick="jQuery('#P1').YTPChangeVideo({videoURL: '{{ $file->filename }}', mute:false, addRaster:true})">
                                                <div class="video d-flex flex-row align-items-center justify-content-start">
                                                    <div class="video_image"><div><img src="{{ $file->thumbnail }}" alt=""></div><img class="play_img" src="app-asset/img/play.png" alt=""></div>
                                                    <div class="video_content">
                                                        <div class="video_title">{{ $file->calendar->title }}</div>
                                                        <div class="video_info"><span>Uploaded {{ $file->created_at->diffForHumans() }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="load_more"></div>
                </div>
            </div>

            <!-- Sidebar -->

            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar_background"></div>
                    @include('layouts.parts.calendar')
                    <div class="future_events">
                        @include('layouts.parts.birthday-list')
                    </div>
                    <div class="future_events">
                        @include('layouts.parts.anniversary-list')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
