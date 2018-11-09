@extends('layouts.admin.master')

@section('page-title')
    {{ $user->name }} - GPIB Margamulya
@endsection

@section('content')
<div id="create-post-page">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('admin-asset/img/faces/face1.jpg') }}" style="width: 100%;" alt="profile">
                        </div>
                        <div class="col-md-9">
                            <form>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" value="Administrator" readonly>
                                    </div>
                                </div>
                                @if($user->role_id != 1)
                                    <div class="form-group row">
                                        <label for="post_count" class="col-sm-2 col-form-label">Post Count</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control-plaintext" value="30" readonly>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
