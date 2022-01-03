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
                    <label for="class">Open Date</label>
                    <input type="date" class="form-control" name="opendate" value="{{$file->opendate}}" aria-label="Open Date">
                </div>
                <div class="col-sm">
                    <label for="class">Close Date</label>
                    <input type="date" class="form-control" name="closedate" value="{{$file->closedate}}" aria-label="Close Date">
                </div>
            </div>
            <div class="row g-3 py-2">
                <div class="col-sm">
                    <label for="class">File Reference</label>
                    <input type="text" class="form-control" name="reference" value="{{$file->reference}}" aria-label="Reference">
                </div>
            </div>
            <label for="unit_id">Unit Name/Formation</label>
            <div class="input-group mb-3">
                <select name="unit_id" class="form-control" searchable="Search here...">
                    <option value="{{$file->unit_id}}" selected>{{$file->unit}}</option>
                    @foreach($unit as $u)
                        <option value="{{$u->id}}">&#xf07c; {{$u->name}}</option>
                    @endforeach
                </select>
                <button class="input-group-text" type="button" data-bs-toggle="modal" data-bs-target="#unitModal">
                    <i class="fas fa-folder-plus px-2"></i> 
                    Create Unit/Formation
                </button>
            </div>
            <button class="form-control" type="submit">Update</button>
        </form>
    </div>
</section>
@endsection