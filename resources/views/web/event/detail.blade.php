@extends('layouts.master')

@section('page-title')
    {{ $event->title }}
@endsection

@section('content')
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('app-asset/img/category.jpg') }}" data-speed="0.8"></div>
    <div class="home_content">
        <a href="{{ url('article') }}" class="tag">Events</a>
        <div class="post_title">{{ $event->title }}</div>
        <p class="text-light font-weight-bold">{{ $event->date }}</p>
        <p class="text-light font-weight-bold">{{ $event->start_hour }} - {{ $event->end_hour }}</p>
    </div>
</div>
<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9">
                <div class="post_content">
                    <div class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
                        <div class="author_image"><div><img src="{{ asset('app-asset/img//author.jpg') }}" alt=""></div></div>
                        <div class="post_meta">{{ $event->user->name }}<span>Administrator</span></div>
                        <div class="post_share ml-sm-auto">
                            <span>share</span>
                            <ul class="post_share_list">
                                @if($isMobile == true)
                                <li class="post_share_item"><a href="line://msg/text/?{{ $event->title }} {{ url()->current() }}" data-action="share/line/share"><i class="fab fa-line" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="whatsapp://send?text={{ $event->title }} {{ url()->current() }}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                                @endif
                                <li class="post_share_item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share d-block d-sm-none">
                        <p>share this article</p>
                        <ul class="post_share_list">
                            @if($isMobile == true)
                            <li class="post_share_item"><a href="line://msg/text/?{{ $event->title }} {{ url()->current() }}" data-action="share/line/share"><i class="fab fa-line" aria-hidden="true"></i></a></li>
                            <li class="post_share_item"><a href="whatsapp://send?text={{ $event->title }} {{ url()->current() }}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            @endif
                            <li class="post_share_item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    @if(!empty($event->description))
                    <div class="post_body">
                        <p class="text-justify">{{ $event->description }}</p>
                    </div>
                    @endif
                    <div class="gallery mt-5">
                        @if(!empty($photos))
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Photos</div>
                        </div>
                        <div id="carouselPhotos" class="carousel slide mt-4" data-ride="carousel">
                            @if(count($photos) > 1)
                            <ol class="carousel-indicators">
                                @foreach($photos as $photo)
                                    @if(!empty($photo->mime_type))
                                    <li data-target="#carouselPhotos" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif ></li>
                                    @endif
                                @endforeach
                            </ol>
                            @endif
                            <div class="carousel-inner">
                                @foreach($photos as $photo)
                                    @if(!empty($photo->mime_type))
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img class="d-block w-100" src="{{ $photo->filename }}" alt="slideshow">
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            @if(count($photos) > 1)
                            <a class="carousel-control-prev" href="#carouselPhotos" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselPhotos" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            @endif
                        </div>
                        @endif

                        @if(count($videos) > 0)
                        <div class="blog_section">
                            <div class="section_panel d-flex flex-row align-items-center justify-content-start mt-5">
                                <div class="section_title">Videos</div>
                            </div>
                            <div class="section_content">
                                <div class="row">
                                    <div class="col">
                                        <div class="videos">
                                            <div class="player_container">
                                                <div id="P1" class="player"
                                                     data-property="{videoURL:'{{ $videos[0]->filename }}',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1}">
                                                </div>
                                            </div>
                                            <div class="playlist">
                                                <div class="playlist_background"></div>

                                                @foreach($videos as $file)
                                                <div class="video_container video_command @if($loop->first) active @endif" onclick="jQuery('#P1').YTPChangeVideo({videoURL: '{{ $file->filename }}', mute:false, addRaster:true})">
                                                    <div class="video d-flex flex-row align-items-center justify-content-start">
                                                        <div class="video_image"><div><img src="{{ $file->thumbnail }}" alt="video"></div><img class="play_img" src="{{ asset('app-asset/img/play.png') }}" alt="play"></div>
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script id="dsq-count-scr" src="//gpip-marga-mulya.disqus.com/count.js" async></script> -->
@endsection
