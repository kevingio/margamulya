@extends('layouts.master')

@section('page-title')
    GPIP Margamulya
@endsection

@section('content')
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="app-asset/img/category.jpg" data-speed="0.8"></div>
</div>
<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9">
                <div class="main_content">
                    <div class="category">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Articles</div>
                        </div>
                        <div class="section_content clearfix">
                            <div id="grid" data-columns>
                                @foreach($articles as $article)
                                    @if(!empty($article->background_img))
                                    <div class="card card_default card_small_with_image grid-item">
                                        <img class="card-img-top" src="{{ $article->background_img }}" alt="{{ $article->title }}">
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
                        <div class="row justify-content-md-center pagination-wrapper">
                            <div class="col-md-auto">
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    {{ $articles->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="load_more">

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar_background"></div>
                    @include('layouts.parts.calendar')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
