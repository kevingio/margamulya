@extends('layouts.admin.master')

@section('page-title')
    Photo - GPIB Margamulya
@endsection

@section('content')

<!-- Modal Add Photo -->
<div class="modal fade" id="add-photo-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-add-photo" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row photo-section" style="display: none;">
                        <div class="col-md-12">
                            <img src="https://images.unsplash.com/photo-1473621038790-b778b4750efe?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=67314e10587699eadaad3f904df7b6a4&auto=format&fit=crop&w=1504&q=80" class="img-preview" alt="preview-photo" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                            <span class="btn btn-warning btn-file">
                                <i class="mdi mdi-file-document"></i>
                                Browse <input type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">
                            </span>
                            <br>
                            <small class="text-danger d-none">Photo must be gif, jpg, jpeg or png!</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="event" class="col-sm-2 col-form-label">Event</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="calendar_id" required></select>
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

<!-- Modal Edit Photo -->
<div class="modal fade" id="edit-photo-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialo modal-dialog-centeredg" role="document">
        <div class="modal-content">
            <form id="form-edit-photo" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row photo-section">
                        <div class="col-md-12">
                            <img src="#" class="img-preview" alt="preview-img" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                            <span class="btn btn-warning btn-file">
                                <i class="mdi mdi-file-document"></i>
                                Browse <input type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">
                            </span>
                            <br>
                            <small class="text-danger d-none">Photo must be gif, jpg, jpeg or png!</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="event" class="col-sm-2 col-form-label">Event</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="select2-event" name="calendar_id" required></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-pencil"></i>
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Preview Photo -->
<div class="modal fade" id="img-preview-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered h-100 d-flex flex-column justify-content-center my-0" role="document">
        <div class="modal-content">
            <img src="" class="img-preview" alt="preview" />
        </div>
    </div>
</div>

<div class="row" id="photo-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">Photo Collection</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-photo-modal">
                            <i class="mdi mdi-plus"></i>
                            Add New Photo
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="photo-datatable">
                        <thead>
                        <tr>
                            <th>Event</th>
                            <th class="no-sort no-search">Photo</th>
                            <th class="no-search">Size</th>
                            <th class="no-search">Added at</th>
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
