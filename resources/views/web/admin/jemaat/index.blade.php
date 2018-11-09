@extends('layouts.admin.master')

@section('page-title')
    Jemaat - GPIB Margamulya
@endsection

@section('content')

<!-- Modal Tambah Jemaat -->
<div class="modal fade" id="add-jemaat-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-jemaat">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jemaat Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="enter name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="dob" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-4">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                           name="gender"
                                           value="M" checked> Male
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                           name="gender"
                                           value="F"> Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Marriage</label>
                        <div class="col-sm-4">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input add-jemaat-marriage"
                                           name="marriage"
                                           value="yes"> Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input add-jemaat-marriage"
                                           name="marriage"
                                           value="no" checked> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="add-jemaat-couple" style="display: none;">
                        <div class="form-group row">
                            <label for="couple" class="col-sm-2 col-form-label">Couple</label>
                            <div class="col-sm-10">
                                <select class="form-control select2-couple" name="couple_id"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="anniversary" class="col-sm-2 col-form-label">Anniversary</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" name="anniversary">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="address" class="form-control" rows="8" placeholder="enter address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sector" class="col-sm-2 col-form-label">Sector</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sector" placeholder="enter sector" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i>
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Jemaat -->
<div class="modal fade" id="edit-jemaat-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-jemaat">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jemaat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="input-name" placeholder="enter name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="dob" id="input-dob" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-4">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                           name="gender"
                                           value="M"> Male
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                           name="gender"
                                           value="F" checked> Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Marriage</label>
                        <div class="col-sm-4">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input edit-jemaat-marriage"
                                           name="marriage"
                                           value="yes"> Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input edit-jemaat-marriage"
                                           name="marriage"
                                           value="no" checked> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="edit-jemaat-couple" style="display: none;">
                        <div class="form-group row">
                            <label for="couple" class="col-sm-2 col-form-label">Couple</label>
                            <div class="col-sm-10">
                                <select class="form-control select2-couple" name="couple_id"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="anniversary" class="col-sm-2 col-form-label">Anniversary</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="input-anniversary" name="anniversary">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="address" class="form-control" id="input-address" rows="8" placeholder="enter address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sector" class="col-sm-2 col-form-label">Sector</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-sector" name="sector" placeholder="enter sector" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i>
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import Excel Jemaat -->
<div class="modal fade" id="import-jemaat-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="" action="{{ route('jemaat.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jemaat Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="input-filename"></h5>
                    <div class="form-group">
                        <span class="btn btn-warning btn-file">
                            <i class="mdi mdi-file-document"></i>
                            Browse <input type="file" name="file" required>
                        </span>
                        <small class="form-text">Download file format <a href="{{ route('download-file') }}">here</a></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-upload"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row" id="jemaat-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">Jemaat Gereja Margamulya</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#import-jemaat-modal">
                            <i class="mdi mdi-upload"></i>
                            Import
                        </button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-jemaat-modal">
                            <i class="mdi mdi-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="jemaat-datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Anniversary</th>
                            <th>Couple</th>
                            <th>Sector</th>
                            <th class="no-sort no-search text-center"></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
