@extends('layouts.admin.master')

@section('page-title')
    Dashboard - GPIB Margamulya
@endsection

@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-account-star text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Online</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $visitors['online'] }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Updated at {{ date('H:i') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-account-multiple text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Visitors</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $visitors['total'] }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Updated at {{ date('H:i') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-clipboard-text text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Articles</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $count['article'] }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Updated at {{ date('H:i') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Jemaat</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $count['jemaat'] }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Updated at {{ date('H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary mb-5">Hall of Fame</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Birthday</h5>
                        <div class="mt-3" style="overflow-y: auto; max-height: 300px;">
                            {!! $temp = '' !!}
                            @foreach($birthday as $item)
                                @if ($temp != $item->dob)
                                    @if(!$loop->first)
                                        </ul>
                                    @endif
                                    <b>{{ $temp = date('d F Y', strtotime($item->dob)) }}</b>
                                    <ul>
                                @endif
                                <li>{{ $item->name }}</li>
                            @endforeach

                            @if(count($birthday) < 1)
                                <p class="text-muted">No data</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Anniversary</h5>
                        <div class="mt-3" style="overflow-y: auto; max-height: 300px;">
                            {!! $temp = '' !!}
                            @foreach($anniversary as $item)
                                @if ($temp != $item->anniversary)
                                    @if(!$loop->first)
                                        </ul>
                                    @endif
                                    <b>{{ $temp = date('d F Y', strtotime($item->anniversary)) }}</b>
                                    <ul>
                                @endif
                                <li>{{ $item->name }}</li>
                            @endforeach

                            @if(count($anniversary) < 1)
                                <p class="text-muted">No data</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary mb-5">Storage Capacity</h4>
                <div class="wrapper d-flex justify-content-between">
                    <p class="display-3 mb-4 font-weight-light">{{ $storage['warta'] + $storage['photo'] + $storage['system'] }} of 1GB</p>
                </div>
                <div class="wrapper">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Photos ({{ $count['photo'] }})</p>
                        <p class="mb-2 text-primary">{{ $storage['photo']*100 }}%</p>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                             role="progressbar" style="width: {{ $storage['photo']*100 }}%" aria-valuenow="{{ $storage['photo']*100 }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="wrapper mt-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Warta ({{ $count['warta'] }})</p>
                        <p class="mb-2 text-success">{{ $storage['warta']*100 }}%</p>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                             role="progressbar" style="width: {{ $storage['warta']*100 }}%" aria-valuenow="{{ $storage['warta']*100 }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="wrapper mt-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">System</p>
                        <p class="mb-2 text-primary">20%</p>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                             role="progressbar" style="width: 20%" aria-valuenow="88"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="wrapper mt-4">
                    <div class="d-flex">
                        <p>Please contact the web developer immediately to upgrade your storage.</p>
                    </div>
                </div>
                <div class="wrapper">
                    <div class="d-flex">
                        @if($isMobile == true)
                        <a href="https://wa.me/628561333111?text=Saya%20ingin%20menambah%20kapasitas%20penyimpanan%20web%20gpibmargamulya.or.id" class="btn social-btn btn-rounded btn-success mr-2">
                            <i class="mdi mdi-whatsapp"></i>
                        </a>
                        <a href="line://msg/text/?Saya ingin menambah kapasitas penyimpanan web gpibmargamulya.or.id" class="btn social-btn btn-rounded btn-line mr-2">
                            <i class="fab fa-line"></i>
                        </a>
                        @endif
                        <a href="mailto:kevinevraldo@gmail.com" class="btn social-btn btn-rounded btn-danger mr-2">
                            <i class="mdi mdi-email"></i>
                        </a>
                        <span class="ml-3 contact-dev">
                            <span>Kevin Giovanni</span>
                            <br>
                            08112596097
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
