@extends('layouts.master')

@section('page-title')
    GPIB Margamulya
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
                            <div class="section_title">Directory</div>
                            <div class="section_tags ml-auto list-group" role="tablist">
                                <ul class="tab-list-direktori">
                                    <li class="tab-item active"><a href="javascript: void(0)" data-target="#tab-komisi">Komisi</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-pelkat">Pelkat</a></li>
                                </ul>
                            </div>
                            <div class="section_panel_more d-md-none d-sm-block">
                                <ul>
                                    <li>more
                                        <ul class="mobile tab-list-direktori">
                                            <li class="tab-item active"><a href="javascript: void(0)" data-target="#tab-komisi">Komisi</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-pelkat">Pelkat</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section_content">
                            <div class="tab-content tab-direktori">
                                <div class="tab-pane active" id="tab-komisi">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Komisi</h3>
                                                <h4 class="font-weight-bold">GPIB Jemaat "Marga Mulya" Yogyakarta</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                @include('web.directory.komisi')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-pelkat">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/Logo Pelkat.jpg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Pengurus Pelkat</h3>
                                                <h4 class="font-weight-bold">GPIB Jemaat "Marga Mulya" Yogyakarta</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                @include('web.directory.pelkat')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
