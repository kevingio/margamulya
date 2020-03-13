@extends('layouts.master')

@section('page-title')
    About GPIB - GPIB Margamulya
@endsection

@section('content')
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('app-asset/img/category.jpg') }}" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Main Content -->

            <div class="col-lg-9">
                <div class="main_content">

                    <!-- Category -->

                    <div class="category">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">GPIB</div>
                            <div class="section_tags ml-auto list-group" role="tablist">
                                <ul class="tab-list-direktori">
                                    <li class="tab-item active"><a href="javascript: void(0)" data-target="#tab-sejarah">Sejarah</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-visi-misi">Visi dan Misi</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-pemahaman-iman">Pemahaman Iman</a></li>
                                </ul>
                            </div>
                            <div class="section_panel_more d-md-none d-sm-block">
                                <ul>
                                    <li>more
                                        <ul class="mobile tab-list-direktori">
                                            <li class="tab-item active"><a href="javascript: void(0)" data-target="#tab-sejarah">Sejarah</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-visi-misi">Visi dan Misi</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-pemahaman-iman">Pemahaman Iman</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section_content">
                            <div class="tab-content tab-direktori">
                                <div class="tab-pane active" id="tab-sejarah">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Sejarah</h3>
                                                <h4>Gereja Protestan di Indonesia Bagian Barat (GPIB)</h4>
                                            </div>
                                            <div class="card-content mb-5 text-justify">
                                                @include('web.about.gpib.sejarah')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-visi-misi">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Visi dan Misi</h3>
                                                <h4>Gereja Protestan di Indonesia Bagian Barat (GPIB)</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                @include('web.about.gpib.visi-misi')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-pemahaman-iman">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Pemahaman Iman</h3>
                                                <h4>Gereja Protestan di Indonesia Bagian Barat (GPIB)</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                <ol class="pemahaman-iman-gpib">
                                                    @include('web.about.gpib.pendalaman-iman')
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sidebar -->

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
