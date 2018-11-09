@extends('layouts.admin.master')

@section('page-title')
    Calendar - GPIB Margamulya
@endsection

@section('content')

<!-- Modal Add Event -->
<div class="modal fade" id="add-event-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-event" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Event</label>
                        <div class="col-sm-10">
                            <textarea name="title" rows="5" class="form-control" placeholder="enter title" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 col-form-label">Start</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="start_hour" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label">End</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="end_hour" required>
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

<!-- Modal Edit Event -->
<div class="modal fade" id="edit-event-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-event" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Event</label>
                        <div class="col-sm-10">
                            <textarea name="title" rows="5" class="form-control" id="title" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 col-form-label">Start</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="start_hour" name="start_hour" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label">End</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="end_hour" name="end_hour" required>
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
    <div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0" role="document">
        <div class="modal-content">
            <img src="" class="img-preview" alt="preview" />
        </div>
    </div>
</div>

<div class="row" id="calendar-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">Calendar</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <select class="form-control filter-calendar" id="select-type">
                            <option value="calendar">Future Event</option>
                            <option value="event">Past Event</option>
                        </select>
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-event-modal">
                            <i class="mdi mdi-plus"></i>
                            Add New
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="calendar-datatable">
                        <thead>
                        <tr>
                            <th>Event</th>
                            <th class="no-sort">Thumbnail</th>
                            <th class="no-search">Start</th>
                            <th class="no-search">End</th>
                            <th>Date</th>
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
