@extends('layouts.admin.master')

@section('page-title')
    {{ auth()->user()->name }} - GPIB Margamulya
@endsection

@section('sweet-alert')
    @if (Session::has('sweet_alert.alert'))
    <script>
        swal({!! Session::get('sweet_alert.alert') !!});
    </script>
    @endif
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('submit-change-password') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Old Password</label>
                                <div class="col-sm-7">
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">New Password</label>
                                <div class="col-sm-7">
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Retype Password</label>
                                <div class="col-sm-7">
                                    <input type="password" name="retype" class="form-control" required>
                                </div>
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-dark mt-4">
                                <i class="mdi mdi-keyboard-backspace"></i>
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary mt-4">
                                <i class="mdi mdi-upload"></i>
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
