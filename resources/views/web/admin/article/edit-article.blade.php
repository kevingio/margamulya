@extends('layouts.admin.master')

@section('page-title')
    Edit Article - GPIB Margamulya
@endsection

@section('content')
<div id="create-article-page">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-sm-center text-md-left">
                            <h4 class="mb-4">Edit Article</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('article.update', [$article->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Background Image</label>
                                    @if(!empty($article->background_img))
                                    <img src="{{ $article->background_img }}" class="img-preview-post" alt="gambar-post">
                                    @else
                                    <img src="{{ asset('app-asset/img/category.jpg') }}" class="img-preview-post" alt="gambar-post-default">
                                    @endif
                                    <div class="mt-3">
                                        <span class="btn btn-warning btn-file">
                                            <i class="mdi mdi-file-document"></i>
                                            Browse <input type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">
                                        </span>
                                        <br>
                                        <small class="text-danger d-none">Image must be gif, jpg, jpeg or png!</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $article->title }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control summernote" name="content">{{ $article->content }}</textarea>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary" name="button">
                                        <i class="mdi mdi-pencil"></i>
                                        Edit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
