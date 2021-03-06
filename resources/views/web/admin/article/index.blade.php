@extends('layouts.admin.master')

@section('page-title')
    Articles - GPIB Margamulya
@endsection

@section('content')

<div class="row" id="article-page">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 text-sm-center text-md-left">
                        <h4 class="mb-4">All Articles</h4>
                    </div>
                    <div class="col-md-7 text-sm-center text-md-right">
                        <a class="btn btn-success" href="{{ url('/admin/article/create') }}">
                            <i class="mdi mdi-plus"></i>
                            Create Article
                        </a>
                    </div>
                </div>
                @if(auth()->user()->role === 'admin')
                <select class="select2 pr-2" id="select-type">
                    <option value="all">Semua Artikel</option>
                    @foreach ($articleTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="article-datatable">
                        <thead>
                        <tr>
                            <th class="wrap-text">Title</th>
                            <th>Author</th>
                            <th>Views</th>
                            <th>Posted at</th>
                            <th class="no-search no-sort text-center"></th>
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
