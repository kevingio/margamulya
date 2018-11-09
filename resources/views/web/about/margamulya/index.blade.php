@extends('layouts.master')

@section('page-title')
    GPIB Margamulya
@endsection

@section('content')
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('app-asset/img/category.jpg') }}" data-speed="0.8"></div>
</div>

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">
            <div class="col-lg-9">
                <div class="main_content">
                    <div class="category">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">GPIB Marga Mulya</div>
                            <div class="section_tags ml-auto list-group d-none d-xl-block" role="tablist">
                                <ul class="tab-list-direktori">
                                    <li class="tab-item active"><a href="javascript: void(0)" data-target="#tab-sejarah">Sejarah</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-pendeta">Pendeta</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-majelis-jemaat">Majelis Jemaat</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-phmj">PHMJ</a></li>
                                    <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-organisasi">Struktur Organisasi</a></li>
                                </ul>
                            </div>
                            <div class="section_panel_more d-xl-none d-sm-block">
                                <ul>
                                    <li>menu
                                        <ul class="mobile tab-list-direktori">
                                            <li class="tab-item active"><a href="javascript: void(0)" data-target="#tab-sejarah">Sejarah</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-pendeta">Pendeta</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-majelis-jemaat">Majelis Jemaat</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-phmj">PHMJ</a></li>
                                            <li class="tab-item"><a href="javascript: void(0)" data-target="#tab-organisasi">Struktur Organisasi</a></li>
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
                                                <h4>Marga Mulya Yogyakarta</h4>
                                            </div>
                                            <div class="card-content mb-5 text-justify">
                                                @include('web.about.margamulya.sejarah')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-pendeta">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Pendeta Majelis Umat</h3>
                                                <h4>Gereja Protestan di Indonesia Bagian Barat (GPIB)</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                @include('web.about.margamulya.pendeta')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-majelis-jemaat">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Diaken dan Penatua Majelis Jemaat</h3>
                                                <h4>Gereja Protestan di Indonesia Bagian Barat (GPIB)</h4>
                                                <h4>Periode Masa Bakti 2017 - 2022</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                @include('web.about.margamulya.majelis-jemaat')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-phmj">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('app-asset/img/bible.jpeg') }}" alt="bible">
                                        <div class="card-body">
                                            <div class="card-title text-dark text-center my-5">
                                                <h3 class="font-weight-bold">Pelaksana Harian Majelis Jemaat</h3>
                                                <h4>Gereja Protestan di Indonesia Bagian Barat (GPIB)</h4>
                                                <h4>Periode Masa Bakti 2017 - 2020</h4>
                                            </div>
                                            <div class="card-content mb-5">
                                                @include('web.about.margamulya.phmj')
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
