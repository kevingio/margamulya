@extends('layouts.master')

@section('page-title')
    Warta - GPIB Margamulya
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
                            <div class="section_title">Warta</div>
                        </div>
                        <div class="section_content clearfix">
                            @if(sizeof($wartas) == 0)
                            <span>No records</span>
                            @endif
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
                        <div class="row justify-content-md-center pagination-wrapper">
                            <div class="col-md-auto">
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    {{ $wartas->links() }}
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
