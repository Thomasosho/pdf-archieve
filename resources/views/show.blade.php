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
            <div class="col-lg-10 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="/files"> Back</a>
                </div>
            </div>
            <div class="col-lg-2 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('file.edit',$file->id)}}"> Edit</a>
                </div>
            </div>
        </div>
        <br>
        <h3>{{$file->file}}</h3>
        <div class="row g-3 py-2">
            <div class="col-sm">
                <label for="date">Date</label>
                <input type="text" class="form-control" value="{{$file->date}}" aria-label="Date" readonly>
            </div>
            <div class="col-sm-4">
                <label for="person">Person Responsible</label>
                <input type="text" class="form-control" value="{{$file->person}}" aria-label="Person Responsible" readonly>
            </div>
        </div>
        <div class="row g-3 py-2">
            <div class="col-sm">
                <label for="description">Description</label>
                <input type="text" class="form-control" value="{{$file->description}}" aria-label="Description" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md">
                @if($file->extension == 'pdf'||$file->extension == 'PDF')
                    <h5>Preview <span>{{$file->file}}</span></h5>
                    <iframe
                        src="https://the-archiever.herokuapp.com/app/storage/app/public/documents/{{$file->file}}"
                        frameBorder="0"
                        scrolling="auto"
                        width="100%"
                        class="full"
                    ></iframe>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection