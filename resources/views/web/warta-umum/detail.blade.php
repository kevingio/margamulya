@extends('layouts.master')

@section('page-title')
    {{ $warta->title }}
@endsection

@section('content')
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('app-asset/img/category.jpg') }}" data-speed="0.8"></div>
    <div class="home_content">
        <a href="{{ url('warta-umum') }}" class="tag">Warta</a>
        <div class="post_title">{{ $warta->title }}</div>
    </div>
</div>
<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9 mb-5">
                <div class="post_content">
                    <div class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
                        <div class="author_image">
                            <div>
                                @if(empty($article->user->avatar))
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd5_kbfqZdTTsP506OSSvpu9A5nU6JgzV-qfrBq_N_513GdBrZ"
                                    alt="">
                                @else
                                <img src="{{ Storage::url($article->user->avatar) }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="post_meta">{{ $warta->user->name }}<span>{{ date('l, d F Y', strtotime($warta->created_at)) }} at {{ date('H:i', strtotime($warta->created_at)) }}</span></div>
                        <div class="post_share ml-sm-auto">
                            <span>share</span>
                            <ul class="post_share_list">
                                @if($isMobile == true)
                                <li class="post_share_item"><a href="line://msg/text/?{{ $warta->title }} {{ url()->current() }}" data-action="share/line/share"><i class="fab fa-line" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="whatsapp://send?text={{ $warta->title }} {{ url()->current() }}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                                @endif
                                <li class="post_share_item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share d-block d-sm-none">
                        <p>share this post</p>
                        <ul class="post_share_list">
                            @if($isMobile == true)
                            <li class="post_share_item"><a href="line://msg/text/?{{ $warta->title }} {{ url()->current() }}" data-action="share/line/share"><i class="fab fa-line" aria-hidden="true"></i></a></li>
                            <li class="post_share_item"><a href="whatsapp://send?text={{ $warta->title }} {{ url()->current() }}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            @endif
                            <li class="post_share_item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    @if (env('APP_ENV') == 'production')
                    <object data="https://docs.google.com/gview?embedded=true&url={{ url('/').$warta->path }}" width="100%" height="700"></object>
                    @else
                    <iframe src="{{ $warta->path }}" width="100%" height="700px" frameBorder="0"></iframe>
                    @endif
                </div>
                @if($wartas->count() > 0)
                <div class="similar_posts">
                    <div class="post_comment">
                        <div class="post_comment_title">Warta Umum</div>
                        <div id="grid" data-columns>
                            @foreach($wartas as $warta)
                            <div class="card card_default card_small_no_image grid-item">
                                <div class="card-body">
                                    <div class="card-title card-title-small"><a href="{{ route('show-warta', [$warta->id]) }}">{{ $warta->title }}</a></div>
                                    <small class="post_meta"><a href="#">{{ $warta->user->name }}</a><span>{{ $warta->created_at->diffForHumans() }}</span></small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
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
@endsection
