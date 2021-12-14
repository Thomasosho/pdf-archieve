@extends('layouts.app')

@section('content')
<style>
    .full {
        height: 100vh !important;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="/files"> Back</a>
                </div>
            </div>
        </div>
        <br>
        <h3>Edit {{$file->file}}</h3>
        <form action="{{ route('file.update', $file->id) }}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            @method('PATCH')
            <div class="row g-3 py-2">
                <div class="col-sm">
                    <label for="class">Date</label>
                    <input type="date" class="form-control" name="date" value="{{$file->date}}" aria-label="Date">
                </div>
                <div class="col-sm">
                    <label for="class">Keyword</label>
                    <input type="text" class="form-control" name="keyword" value="{{$file->keyword}}" aria-label="keywords seperated by commas">
                </div>
            </div>
            <div class="row g-3 py-2">
                <div class="col-sm">
                    <label for="class">Description</label>
                    <input type="text" class="form-control" name="description" value="{{$file->description}}" aria-label="Description">
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="file" name="file" accept=".doc,.docx,.pdf,.ppt,.pptx,.ods,.odt,.odp,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <button class="form-control" type="submit">Update</button>
        </form>
    </div>
</section>
@endsection