@extends('layouts.admin.master')

@section('page-title')
    {{ $user->name }} - GPIB Margamulya
@endsection

@section('sweet-alert')
    @if (session()->has('sweet_alert.alert'))
    <script>
        swal({!! session()->get('sweet_alert.alert') !!});
    </script>
    @endif
@endsection

@section('content')
<div id="create-post-page">
    <form class="" action="{{ route('profile.update', [$user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="circle">
                                    @if(empty($user->avatar))
                                    <img class="profile-pic" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd5_kbfqZdTTsP506OSSvpu9A5nU6JgzV-qfrBq_N_513GdBrZ">
                                    @else
                                    <img class="profile-pic" src="{{ $user->avatar }}">
                                    @endif
                                </div>
                                <div class="p-image">
                                    <i class="fa fa-camera upload-button"></i>
                                    <input class="file-upload" type="file" name="photo" accept="image/x-png,image/gif,image/jpeg"/>
                                </div>
                                <!-- <img src="{{ asset('admin-asset/img/faces/face1.jpg') }}" style="width: 100%;" alt="profile"> -->
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label font-weight-bold">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label font-weight-bold">Username</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <a href="{{ route('change-password') }}" class="btn btn-dark" name="button">
                                            <i class="mdi mdi-lock"></i>
                                            Change Password
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
