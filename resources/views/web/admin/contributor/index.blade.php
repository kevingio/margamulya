@extends('layouts.admin.master')

@section('page-title')
Kontributor - GPIB Margamulya
@endsection

@section('content')

<!-- Modal Tambah Kontributor -->
<div class="modal fade" id="add-kontributor-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-add-contributor">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kontributor Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-5 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" placeholder="enter name"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-5 col-form-label">Bidang</label>
                        <div class="col-sm-7">
                            <select class="form-control select2" name="contributor_type_id" required>
                                @foreach ($contributorTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="username" placeholder="enter username" autocomplete="off"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="password" required>
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

<!-- Modal Edit Contributor -->
<div class="modal fade" id="edit-contributor-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-edit-contributor">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kontributor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-5 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" placeholder="enter name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-5 col-form-label">Bidang</label>
                        <div class="col-sm-7">
                            <select class="form-control select2" name="contributor_type_id" required>
                                @foreach ($contributorTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="username" placeholder="enter username" autocomplete="off"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="kosongkan jika tidak ingin diganti">
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

<div class="row" id="contributor-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">Kontributor Gereja Margamulya</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-kontributor-modal">
                            <i class="mdi mdi-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="contributor-datatable">
                        <thead>
                            <tr>
                                <th width="30%">Name</th>
                                <th>Username</th>
                                <th>Bagian</th>
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