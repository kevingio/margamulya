@extends('layouts.master')

@section('page-title')
    Event - GPIP Margamulya
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
                            <div class="section_title">Events</div>
                        </div>
                        <div class="section_content clearfix">
                            @if(sizeof($events) == 0)
                            <span>No records</span>
                            @endif
                            <div id="grid" data-columns>
                                @foreach($events as $event)
                                @if($event->thumbnail)
                                <div class="card card_default card_small_with_image grid-item">
                                    <img class="card-img-top" src="{{ $event->thumbnail }}" alt="thumbnail" />
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="{{ route('show-event', [$event->id]) }}">{{ $event->title }}</a></div>
                                        <small class="post_meta">{{ $event->date }}</small>
                                    </div>
                                </div>
                                @else
                                <div class="card card_default card_small_no_image grid-item">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="{{ route('show-event', [$event->id]) }}">{{ $event->title }}</a></div>
                                        <small class="post_meta">{{ $event->date }}</small>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="row justify-content-md-center pagination-wrapper">
                            <div class="col-md-auto">
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    {{ $events->links() }}
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
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
