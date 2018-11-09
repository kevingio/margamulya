@extends('layouts.admin.master')

@section('page-title')
    Warta Jemaat - GPIB Margamulya
@endsection

@section('content')

<!-- Modal Add Warta Jemaat -->
<div class="modal fade" id="add-warta-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-warta" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Warta Jemaat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="title" rows="8" placeholder="enter title" required></textarea>
                            <input type="hidden" name="type" value="jemaat" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <h5 class="input-filename"></h5>
                            <div class="form-group">
                                <span class="btn btn-warning btn-file">
                                    <i class="mdi mdi-file-document"></i>
                                    Browse
                                    <input type="file" name="file">
                                </span>
                                <small class="text-danger" class="error" style="display: none;">*required</small>
                            </div>
                            <p class="text-danger" class="error_message"></p>
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

<!-- Modal Edit Warta Jemaat -->
<div class="modal fade" id="edit-warta-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-warta" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Warta Jemaat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="input-title" name="title" rows="8" placeholder="enter title" required></textarea>
                            <input type="hidden" name="type" value="jemaat" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <h5 class="input-filename"></h5>
                            <div class="form-group">
                                <span class="btn btn-warning btn-file">
                                    <i class="mdi mdi-file-document"></i>
                                    Browse
                                    <input type="file" name="file">
                                </span>
                                <small class="text-danger" class="error" style="display: none;">*required</small>
                            </div>
                            <p class="text-danger" class="error_message"></p>
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

<!-- Modal Preview Warta Jemaat -->
<div class="modal fade" id="preview-warta-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg h-100 d-flex flex-column justify-content-center my-0" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="warta-text-modal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <iframe width="100%" height="450px" id="warta-iframe-modal" frameBorder="0"></iframe>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row" id="warta-jemaat-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">Warta Jemaat</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-warta-modal">
                            <i class="mdi mdi-plus"></i>
                            Add New
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="warta-jemaat-datatable">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Uploader</th>
                            <th>Size</th>
                            <th>Added at</th>
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
