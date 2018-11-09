@extends('layouts.admin.master')

@section('page-title')
    Video - GPIB Margamulya
@endsection

@section('content')

<!-- Modal Add Video -->
<div class="modal fade" id="add-video-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-video">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="filename" placeholder="enter youtube link" autocomplete="off" required>
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

<!-- Modal Edit Video -->
<div class="modal fade" id="edit-video-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-video">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="filename" placeholder="enter youtube link" id="input-filename" autocomplete="off" required>
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

<!-- Modal Preview Video -->
<div class="modal fade" id="preview-video-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <iframe src="" class="video-preview" frameBorder="0"></iframe>
        </div>
    </div>
</div>

<div class="row" id="video-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">Video Collection</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-video-modal">
                            <i class="mdi mdi-plus"></i>
                            Add New Video
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="video-datatable">
                        <thead>
                        <tr>
                            <th>Event</th>
                            <th class="no-sort no-search">Link</th>
                            <th class="no-search">Uploader</th>
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
